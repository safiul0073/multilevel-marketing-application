import React, { useState } from 'react'
import {useForm} from "react-hook-form"
import { useNavigate } from 'react-router-dom'
import * as yup from "yup";
import { yupResolver } from '@hookform/resolvers/yup';
import { useMutation } from 'react-query';
import {OTPSenderFunc} from '../../hooks/queries/auth';
import LoaderAnimation from '../common/LoaderAnimation';
import Cookies from 'js-cookie';



export const CheckerOTP = () => {

  let Navigate = useNavigate();

  const [backendError, setBackendError] = useState();

  const [Error, setError] = useState();

  const [OTP, setOTP] = useState("");


    const {
      mutate: OTPMutate,
      isLoading: loading,
      reset,
      isError,
      isSuccess,
    } = useMutation(OTPSenderFunc, {
      onSuccess: (data) => {
        Cookies.set("otp",data?.code)
        Navigate("/staff/reset-password");
      },
      onError: (err) => {
      console.log(err);
        let errorobj = err?.response?.data?.data?.json_object;
        setBackendError({
          ...backendError,
          ...errorobj,
        });
      //   {
      //     err?.response?.data?.data?.json_object.message && (
      //       cogoToast.error(
      //         <div>
      //           <b>{err?.response?.data?.data?.json_object.message}</b>
      //         </div>,
      //       )
      //     )
      //   }

      },
    });

    const onValidate = (e)=>{
      const otp = e.target.value;
      if(otp){
        setOTP(otp);
      }
    }
    
    const onSubmit = () => {
      OTPMutate({code:OTP});
    };
    if(loading){
      return <LoaderAnimation/>
    }

  return (
    <div className="w-screen h-screen flex items-center justify-center">
            <div>
                    <div className='w-1/2 mx-auto mt-[100px]'>
                    <label htmlFor="username" className='text-gray-500 font-semibold'>Please Check your email to get the code</label>
                    <input type="number"
                        className='w-full h-12 rounded-lg outline-none px-4 text-gray-700 border-2' 
                        value={OTP}  
                        onChange={onValidate}
                        />
                        <p className='text-red-500 italic font-light py-2'>{Error??backendError}</p>
                    </div>
                    <div className='flex justify-center items-center'>
                        <button className='px-4 py-2 text-white bg-gray-800 hover:bg-gray-600 my-4 rounded-md' onClick={onSubmit}>Submit</button>
                    </div>
            </div>
    </div>
  )
}

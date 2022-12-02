import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { useMutation } from 'react-query';
import {OTPSenderFunc} from '../../hooks/queries/auth';
import Cookies from 'js-cookie';
import  toast  from 'react-hot-toast';

export const CheckerOTP = () => {

  let Navigate = useNavigate();

  const [backendError, setBackendError] = useState();

  const [Error, setError] = useState();

  const [OTP, setOTP] = useState("");

    const {
      mutate: OTPMutate,
      isLoading,
    } = useMutation(OTPSenderFunc, {
      onSuccess: (data) => {
        toast.success("Your code is currect!", {
            position: 'top-right'
        });
        Cookies.set("otp",data?.code)
        Navigate("/staff/reset-password");
      },
      onError: (err) => {
        let errorobj = err?.response?.data?.data?.json_object;
        setBackendError({
          ...backendError,
          ...errorobj,
        });
      },
    });

    const onValidate = (e)=>{
      const otp = e.target.value;
      setOTP(otp)
        setError("")
    }

    const onSubmit = () => {
        if (!OTP) {
            setError("Please enter your otp code from email")
        }
      OTPMutate({code:OTP});
    };

  return (
    <div className="w-screen h-screen flex items-center justify-center">
        <div className='w-1/2  mx-auto'>
        <h1 className='text-center text-blue-600 text-xl mb-10'>Please Check your email to get the code</h1>
            <div className='formGroup'>
                <label htmlFor="username" className='label-style'>Code</label>
                <input type="number"
                    className='form-control'
                    value={OTP}
                    onChange={onValidate}
                    placeholder="550066"
                    />
                <p className='error-message'>{Error??backendError}</p>
            </div>

            <div className='flex justify-center items-center'>
            {isLoading ? (
                        <>
                            <button className="btn  btn-secondary flex justify-center align-center" type="button" disabled>
                                <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing ...
                            </button>
                        </>
                        ) :
                        <button className='btn btn-secondary w-1/3' onClick={onSubmit}>Submit</button>
            }
            </div>
        </div>
    </div>
  )
}

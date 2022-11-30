import React, { useState } from 'react'
import {useForm} from "react-hook-form"
import { useNavigate } from 'react-router-dom'
import { UseStore } from '../../store'
import * as yup from "yup";
import { yupResolver } from '@hookform/resolvers/yup';
import { useMutation } from 'react-query';
import {EmailSenderFunc} from '../../hooks/queries/auth';

export const OtpRequest = () => {
    let Navigate = useNavigate();
    const store = UseStore();
    const [backendError, setBackendError] = useState();

    let schema = yup.object({
    email: yup.string().email().required() // pass your error message string
    });

    const { register, handleSubmit, formState: { errors } } = useForm({
        resolver: yupResolver(schema)
      });


      const {
        mutate: EmailMutate,
        isLoading: loading,
        reset,
        isError,
        isSuccess,
      } = useMutation(EmailSenderFunc, {
        onSuccess: (data) => {

          if (data) {
            console.log(data);

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: 'An Email has been sent for OTP code'
            })
            setTimeout(() => {
                // updateAxiosToken(data?.token)
                // setToken(data?.token)
                navigate("/staff/otp-checker");
                // callUserData()
            }, 3000)

          }
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
      
      const onSubmit = (data) => {
        console.log("data");
        // EmailMutate(data)
        // console.log(schema);
      };
  return (
    <div className="w-screen h-screen flex items-center justify-center">
        <form onSubmit={handleSubmit(onSubmit)} action="">
            <div>
                    <div className='w-1/2 mx-auto mt-[100px]'>
                    <label htmlFor="username" className='text-gray-500 font-semibold'>Please Enter Your Email to Validate</label>
                    <input type="text"
                        // {...register("username")}
                        className='w-full h-12 rounded-lg outline-none px-4 text-gray-700 border-2'   />
                        <p className='text-red-500 italic font-light py-2'>{errors.err}</p>
                    </div>
                    <div className='flex justify-center items-center'>
                        <button type='submit' className='px-4 py-2 text-white bg-gray-800 hover:bg-gray-600 my-4 rounded-md'>Submit</button>
                    </div>
            </div>
        </form>

    </div>
  )
}

import React, { useState } from 'react'
import { useForm } from "react-hook-form";
import * as yup from "yup";
import { yupResolver } from '@hookform/resolvers/yup';
import { useMutation } from 'react-query';
import { LoginWithPasswordFunc } from '../../hooks/queries/auth';
import { updateAxiosToken } from '../../config/axios.config';
import { setToken } from '../../helper/functions';
import { Link, useNavigate } from "react-router-dom";
import { UseStore } from '../../store';
import { getUsers } from '../../hooks/queries/auth/auth';
// import Swal from 'sweetalert2';
import Swal from 'sweetalert2/dist/sweetalert2.all.js';

const Login = () => {
    let navigate = useNavigate();
    const store = UseStore();
    const [backendError, setBackendError] = useState()
    const schema = yup
    .object({
      username: yup.string().min(4, "Too Short!")
        .max(50, "Too Long!"),
      password: yup.string().min(6, "Too Short!")
    })
    .required();

    const { register, handleSubmit, formState: { errors } } = useForm({
        resolver: yupResolver(schema)
      });

    const {
        mutate: LoginMutate,
        isLoading: loading,
        reset,
        isError,
        isSuccess,
      } = useMutation(LoginWithPasswordFunc, {
        onSuccess: (data) => {

          if (data?.token) {
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
                title: 'Signed in successfully'
            })
            setTimeout(() => {
                updateAxiosToken(data?.token)
                setToken(data?.token)
                navigate("/staff");
                callUserData()
            }, 3000)

          }
        },
        onError: (err) => {
            if (err?.response?.data?.data?.string_data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Login failed',
                    text: err?.response?.data?.data?.string_data,
                })
            }
          let errorobj = err?.response?.data?.data?.json_object;
          setBackendError({
            ...backendError,
            ...errorobj,
          });

        },
      });
      const onSubmit = (data) => {
        LoginMutate(data)
      };
      async function callUserData () {
        let data = await getUsers()
        if (data?.data?.json_object) {
         store.setUser(data?.data?.json_object)
         store.setAuth(true)
        }
     }
  return (
    <>
        <div className="w-screen h-screen flex items-center justify-center">
          <div className='w-1/2 mx-auto mt-[100px]'>
              <div className='text-center'>
                  <h1 className=' text-blue-600 text-xl mb-24'>Please Enter Your Login Credintials</h1>

              </div>

              <div>
                  <form onSubmit={handleSubmit(onSubmit)} action="">
                      <div>
                          <label htmlFor="username" className='text-gray-500 font-semibold'>Username</label>
                          <input type="text"
                              {...register("username")}
                              className='w-full h-12 rounded-lg outline-none px-4 text-gray-700 border-2'   />
                              <p className='text-red-500 italic font-light py-2'>{errors.username?.message ?? backendError?.username}</p>
                      </div>
                      <div className='my-4'>
                          <label htmlFor="password" className='text-gray-500 font-semibold'>Password</label>
                          <input type="password"
                          {...register("password")}
                          className='w-full h-12 rounded-lg outline-none px-4 text-gray-700 border-2'   />
                            <p className='text-red-500 italic font-light py-2'>{errors.username?.message ?? backendError?.password}</p>
                      </div>
                      <div className='flex justify-center items-center'>
                          <button type='submit' className='px-4 py-2 text-white bg-gray-800 hover:bg-gray-600 my-4 rounded-md'>Submit</button>
                      </div>
                      <div className='flex items-center justify-center'>
                        <Link to="/staff/email-validation" className='underline hover:text-gray-500'>Forgot Password?</Link>
                      </div>
                  </form>
              </div>
          </div>
        </div>
    </>
  )
}

export default Login;

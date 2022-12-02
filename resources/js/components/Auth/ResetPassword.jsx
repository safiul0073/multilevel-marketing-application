import Cookies from 'js-cookie'
import React, { useEffect, useState } from 'react'
import { useMutation } from 'react-query';
import { useNavigate } from 'react-router-dom';
import { resetPassword } from '../../hooks/queries/auth/auth';
import  toast  from 'react-hot-toast';

export const ResetPassword = () => {

    let navigate = useNavigate();
    const [password, setPassword] = useState();
    const [confirmedPass, setConfirmedPass] = useState();
    const [error, setError] = useState();
    const [backendError, setBackendError] = useState();
    const [otp, setOtp] = useState()
    const onSubmit = () => {
    if (!password && !confirmedPass) {
        setError("Please enter password!")
        return false;
    }

    if (password != confirmedPass) {
        setError("Please enter same password!")
        return false;
    }

    if (password && otp) {
        EmailMutate({
            code: otp,
            password: password
        })
    }
    
}

const handlePassword = (e) => {
    setPassword(e.target.value)
    setError("")
}
const handleConfirmPass = (e) => {
    setConfirmedPass(e.target.value)
    setError("")
}
  useEffect(() => {
    let code = Cookies.get("otp");
    if (!code) {
        navigate('/staff/otp-checker')
    }else {
        setOtp(code)
    }

  }, [])
  const {
    mutate: EmailMutate,
    isLoading,
  } = useMutation(resetPassword, {
    onSuccess: (data) => {
        toast.success(data, {
            position: 'top-right'
        });
        Cookies.remove('otp')
        navigate("/staff/login");
    },
    onError: (err) => {
      let errorobj = err?.response?.data?.data?.json_object;
      setBackendError({
        ...backendError,
        ...errorobj,
      });
    },
  });
  return (
    <div>
       <div className="w-screen h-screen flex items-center justify-center">
            <div className='w-1/2 mx-auto'>
                <h1 className='text-center text-blue-600 text-xl mb-10'>Reset your password</h1>
                <div className='formGroup'>
                    <label htmlFor="password" className='label-style'>Password</label>
                    <input
                        type="password"
                        id='password'
                        className='form-control'
                        value={password}
                        placeholder="xxxxxxxx"
                        onChange={handlePassword}
                        />
                        <p className='error-message '>{backendError?.password}</p>
                </div>

                <div className='formGroup'>
                    <label htmlFor="confirmedPass" className='label-style'>Confirm Passwrod</label>
                    <input
                        type="password"
                        id='confirmedPass'
                        className='form-control'
                        value={confirmedPass}
                        placeholder="xxxxxxxx"
                        onChange={handleConfirmPass}
                        />

                </div>
                <p className='error-message my-2 text-center'>{error}</p>
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
    </div>
  )
}

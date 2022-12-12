import React, { useState } from 'react'
import { useForm } from 'react-hook-form'
import Textinput from '../../common/Textinput'

const UserInfo = ({ setTab }) => {
    const [backendError, setBackendError] = useState([])
    const { register, handleSubmit, formState: { errors } } = useForm()

  return (
    <>
        <div className=' w-2/3 h-full mx-auto'>
            <form action="">
                <Textinput
                    label="First name"
                    placeholder="Jhon"
                    register={register}
                    name="first_name"
                    type="text"
                    backendValidationError={backendError?.first_name}
                    error={errors.first_name}
                />
                 <Textinput
                    label="Last name"
                    placeholder="Nill"
                    register={register}
                    name="last_name"
                    type="text"
                    backendValidationError={backendError?.last_name}
                    error={errors.last_name}
                />
                <Textinput
                    label="Username"
                    placeholder="username"
                    register={register}
                    name="username"
                    type="text"
                    backendValidationError={backendError?.username}
                    error={errors.username}
                />
                <Textinput
                    label="Email"
                    placeholder="example@gamil.com"
                    register={register}
                    name="email"
                    type="email"
                    backendValidationError={backendError?.email}
                    error={errors.email}
                />
                <Textinput
                    label="Phone"
                    placeholder="01500000555"
                    register={register}
                    name="phone"
                    type="text"
                    backendValidationError={backendError?.phone}
                    error={errors.phone}
                />
                <Textinput
                    label="Password"
                    placeholder=""
                    register={register}
                    name="password"
                    type="password"
                    backendValidationError={backendError?.password}
                    error={errors.password}
                />
                <Textinput
                    label="Confirmed Password"
                    placeholder=""
                    register={register}
                    name="confirmed"
                    type="password"
                    backendValidationError={backendError?.confirmed}
                    error={errors.confirmed}
                />
            </form>
            <div className='flex justify-around items-center py-2 my-2'>
                <button onClick={() => setTab('sponsor')} className='btn btn-primary'>Back </button>
                <button onClick={() => setTab('summary')} className='btn btn-primary'>Continue </button>
            </div>
        </div>
    </>
  )
}

export default UserInfo

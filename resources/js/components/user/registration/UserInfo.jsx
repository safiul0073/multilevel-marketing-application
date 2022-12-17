import React, { useState } from 'react'
import { useForm } from 'react-hook-form'
import { UseStore } from '../../../store'
import Textinput from '../../common/Textinput'
import * as yup from "yup";
import { yupResolver } from '@hookform/resolvers/yup';

const UserInfo = ({ setTab }) => {
    const [backendError, setBackendError] = useState([])
    const {userRegister} = UseStore()

    const schema = yup
    .object({
        first_name: yup.string().min(4, "Too Short!")
            .required("Enter first name!")
            .max(50, "Too Long!"),
        last_name: yup.string(),
        username: yup.string().required('Please enter username!'),
        email: yup.string().required('Please enter email!'),
        phone: yup.string('Please enter phone number!').max(12, 'Please enter phone number!').min(11, 'Please enter phone number!'),
        password: yup.string().min(8, 'Please enter minimum 8 character!'),
        confirm_password: yup.string().label('confirm password').required().oneOf([yup.ref('password'), null], 'Passwords must match'),
    })
    .required();
    const { register, handleSubmit, formState: { errors } } = useForm({
        resolver: yupResolver(schema)
    })

    const onSubmit = (data) => {
        userRegister.first_name = data.first_name
        userRegister.last_name = data.last_name
        userRegister.email     = data.email
        userRegister.phone     = data.phone
        userRegister.password  = data.password
        userRegister.username  = data.username
        userRegister.password_confirmation = data.confirm_password
        setTab('summary')
    }
  return (
    <>
        <div className=' w-2/3 h-full mx-auto'>
            <form onSubmit={handleSubmit(onSubmit)}>
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
                    name="confirm_password"
                    type="password"
                    backendValidationError={backendError?.confirm_password}
                    error={errors.confirm_password}
                />

                <div className='flex justify-around items-center py-2 my-2'>
                    <button onClick={() => setTab('sponsor')} className='btn btn-primary'>Back </button>
                    <button type='submit' className='btn btn-primary'>Continue </button>
                </div>
            </form>
        </div>
    </>
  )
}

export default UserInfo

import React, { useEffect, useState } from "react";
import { useForm } from "react-hook-form";
import { UseStore } from "../../../store";
import Textinput from "../../common/Textinput";
import * as yup from "yup";
import { yupResolver } from "@hookform/resolvers/yup";

const UserInfo = ({ setTab, backendError }) => {
    const { userRegister } = UseStore();

    const schema = yup
        .object({
            first_name: yup
                .string()
                .min(2, "Too Short!")
                .required("Enter first name!")
                .max(50, "Too Long!"),
            last_name: yup.string(),
            username: yup.string().required("Please enter username!"),
            email: yup.string().required("Please enter email!"),
            phone: yup
                .string("Please enter phone number!")
                .max(12, "Please enter phone number!")
                .min(11, "Please enter phone number!"),
            password: yup.string().min(8, "Please enter minimum 8 character!"),
            confirm_password: yup
                .string()
                .label("confirm password")
                .required()
                .oneOf([yup.ref("password"), null], "Passwords must match"),
        })
        .required();
    const {
        register,
        reset,
        handleSubmit,
        formState: { errors },
    } = useForm({
        resolver: yupResolver(schema),
    });

    useEffect(() => {
        if (userRegister?.first_name) {
            reset(userRegister);
        }
    }, [userRegister]);

    const onSubmit = (data) => {
        userRegister.first_name = data.first_name;
        userRegister.last_name = data.last_name;
        userRegister.email = data.email;
        userRegister.phone = data.phone;
        userRegister.password = data.password;
        userRegister.username = data.username;
        userRegister.password_confirmation = data.confirm_password;
        setTab("summary");
    };
    return (
        <>
            <form onSubmit={handleSubmit(onSubmit)}>
                <Textinput
                    label="First name"
                    placeholder="Jhon"
                    register={register}
                    name="first_name"
                    type="text"
                    backendValidationError={backendError?.first_name}
                    error={errors.first_name}
                    classInput="ring-1 ring-indigo-600"
                />
                <Textinput
                    label="Last name"
                    placeholder="Nill"
                    register={register}
                    name="last_name"
                    type="text"
                    backendValidationError={backendError?.last_name}
                    error={errors.last_name}
                    classInput="ring-1 ring-indigo-600"
                />
                <Textinput
                    label="Username"
                    placeholder="username"
                    register={register}
                    name="username"
                    type="text"
                    backendValidationError={backendError?.username}
                    error={errors.username}
                    classInput="ring-1 ring-indigo-600"
                />
                <Textinput
                    label="Email"
                    placeholder="example@gamil.com"
                    register={register}
                    name="email"
                    type="email"
                    backendValidationError={backendError?.email}
                    error={errors.email}
                    classInput="ring-1 ring-indigo-600"
                />
                <Textinput
                    label="Phone"
                    placeholder="01500000555"
                    register={register}
                    name="phone"
                    type="text"
                    backendValidationError={backendError?.phone}
                    error={errors.phone}
                    classInput="ring-1 ring-indigo-600"
                />
                <Textinput
                    label="Password"
                    placeholder=""
                    register={register}
                    name="password"
                    type="password"
                    backendValidationError={backendError?.password}
                    error={errors.password}
                    classInput="ring-1 ring-indigo-600"
                />
                <Textinput
                    label="Confirmed Password"
                    placeholder=""
                    register={register}
                    name="confirm_password"
                    type="password"
                    backendValidationError={backendError?.confirm_password}
                    error={errors.confirm_password}
                    classInput="ring-1 ring-indigo-600"
                />
                <div className="flex justify-between items-center py-2 my-4">
                    <button
                        onClick={() => setTab("sponsor")}
                        className="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Back
                    </button>
                    <button
                        type="submit"
                        className="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Continue
                    </button>
                </div>
            </form>
        </>
    );
};

export default UserInfo;

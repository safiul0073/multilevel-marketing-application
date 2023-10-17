import React from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useForm } from "react-hook-form";
import { toast } from "react-hot-toast";
import { useMutation } from "react-query";
import { changePassword } from "../../../hooks/queries/user";

const Password = ({ userId }) => {
    const [backendError, setBackendError] = useState([]);

    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
    } = useForm();
    const onSubmit = (data) => {
        data.id = userId;
        changePasswordFunction(data);
    };

    const { mutate: changePasswordFunction, isLoading } = useMutation(
        changePassword,
        {
            onSuccess: (data) => {
                toast.success(data, {
                    position: "top-right",
                });
                reset();
                refatcher();
                closeModal();
            },
            onError: (err) => {
                let errorobj = err?.response?.data?.data?.json_object;
                setBackendError({
                    ...backendError,
                    ...errorobj,
                });
            },
        }
    );

    return (
        <form
            className="space-y-8 mt-10 divide-y divide-gray-200"
            onSubmit={handleSubmit(onSubmit)}
        >
            <div className="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                <div className="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
                    <div>
                        <h3 className="text-lg font-medium leading-6 text-gray-900">
                            Personal Information
                        </h3>
                        <p className="mt-1 max-w-2xl text-sm text-gray-500">
                            Use a permanent address where you can receive mail.
                        </p>
                    </div>

                    <div className="space-y-6 sm:space-y-5">
                        <div className="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label
                                htmlFor="first-name"
                                className="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                            >
                                New Password
                            </label>
                            <div className="mt-1 sm:col-span-2 sm:mt-0">
                                <input
                                    type="password"
                                    name="first-name"
                                    id="first-name"
                                    autoComplete="given-name"
                                    {...register("password", {
                                        required:
                                            "Please enter your new Password.",
                                    })}
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                {backendError && (
                                    <span className="error-message">
                                        {backendError?.password}
                                    </span>
                                )}
                            </div>
                        </div>
                    </div>
                    <div className="space-y-6 sm:space-y-5">
                        <div className="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label
                                htmlFor="first-name"
                                className="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                            >
                                Confirm Password
                            </label>
                            <div className="mt-1 sm:col-span-2 sm:mt-0">
                                <input
                                    type="password"
                                    autoComplete="given-name"
                                    {...register("password_confirmation", {
                                        required:
                                            "Please enter your new confirm Password.",
                                    })}
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                {backendError && (
                                    <span className="error-message">
                                        {backendError?.password_confirmation}
                                    </span>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="pt-5">
                <div className="flex justify-end">
                    <button
                        type="button"
                        className="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        className="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    );
};

export default Password;

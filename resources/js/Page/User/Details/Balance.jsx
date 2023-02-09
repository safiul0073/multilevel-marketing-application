import React, { useState } from "react";
import { useForm } from "react-hook-form";
import toast from "react-hot-toast";
import { useMutation } from "react-query";
import { userBalanceUpdate } from "../../../hooks/queries/user";

const Balance = ({ id, detailsRefetch }) => {
    const [transferTypes, setTransferTypes] = useState([
        {
            name: "Add Balance",
            value: "gift",
            active: true,
        },
        {
            name: "Subtract Balance",
            value: "sub",
            active: false,
        },
        {
            name: "Death Fund",
            value: "death",
            active: false,
        },
        {
            name: "Education Fund",
            value: "education",
            active: false,
        },
        {
            name: "Salary",
            value: "salary",
            active: false,
        },
    ]);

    const handleTransferType = (val) => {
        setTransferTypes(
            transferTypes?.map((type) => {
                return {
                    ...type,
                    active: type?.value === val ? true : false,
                };
            })
        );
    };

    const [backendError, setBackendError] = React.useState()

    const { register, reset, handleSubmit, formState: { errors } } = useForm()
    const onSubmit= (data) => {
        updateUserMutate({
            ...data,
            id: id,
            type: (transferTypes?.find(type => type.active == true)).value
        })
    }

  const {
    mutate: updateUserMutate,
    isLoading,
  } = useMutation(userBalanceUpdate, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            reset()
            detailsRefetch()
        },
        onError: (err) => {
            let error_obj = err?.response?.data?.data?.json_object;
            setBackendError({
                ...backendError,
                ...error_obj,
            });
        },
  });

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="mt-8 flex flex-col">
            <div className="shadow sm:overflow-hidden sm:rounded-md">
                <div className="space-y-6 bg-gray-100 py-6 px-4 sm:p-6">
                    <span className="inline-flex w-full gap-1 p-1 bg-gray-100 border-1 border-gray-300 rounded-md wide-mobile:flex-col mb-50px tablet:mb-40px wide-mobile:mb-30px">

                        {transferTypes?.map((type) => (
                            <button
                                key={Math.random()}
                                type="button"
                                className={`inline-flex grow items-center min-h-50px px-6 mobile:p-4 py-2 rounded-md font-normal focus:outline-none text-center justify-center wide-mobile:justify-start wide-mobile:shadow wide-mobile:shadow-dark/10 hover:shadow-none ${
                                    type?.active
                                        ? "bg-indigo-600 text-white"
                                        : "bg-gray-300 text-gray-800 hover:bg-gray-300"
                                }`}
                                onClick={() => handleTransferType(type?.value)}
                            >
                                {type?.name}
                            </button>
                        ))}
                    </span>
                    <div className="grid grid-cols-12 gap-6">
                        {transferTypes?.find((type) => type?.active)?.value ===
                        "add" ? (
                            <div className="col-span-12">
                                <label
                                    htmlFor="add-amount"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Add Amount
                                </label>
                                <input
                                    type="number"
                                    id="add-amount"
                                    autoComplete="given-name"
                                    {...register('amount')}
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <span className="error-message">{backendError?.amount}</span>
                            </div>
                        ) : (
                            <div className="col-span-12">
                                <label
                                    htmlFor="sub-amount"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Subtract Amount
                                </label>
                                <input
                                    type="number"
                                    id="sub-amount"
                                    {...register('amount')}
                                    autoComplete="given-name"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <span className="error-message">{backendError?.amount}</span>
                            </div>
                        )}
                        <div className="col-span-12">
                            <label
                                htmlFor="message"
                                className="block text-sm font-medium text-gray-700"
                            >
                                Message
                            </label>
                            <textarea
                                type="number"
                                name="message"
                                id="message"
                                rows="5"
                                {...register('message')}
                                autoComplete="given-name"
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            ></textarea>
                            <span className="error-message">{backendError?.message}</span>
                        </div>
                    </div>
                </div>
                <div className="bg-gray-200 px-4 py-3 text-right sm:px-6">
                    {/* <button
                        type="submit"
                        className="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        Cancle
                    </button> */}
                    {
                        isLoading
                        ?
                        <>
                            <button className="rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex justify-center align-center" type="button" disabled>
                                <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing ...
                            </button>
                        </>
                        :
                        <button
                            type="submit"
                            className="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Save
                        </button>
                    }

                </div>
            </div>
        </form>
    );
};

export default Balance;

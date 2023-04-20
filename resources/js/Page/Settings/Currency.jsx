import React from "react";
import Protected from "../../components/HOC/Protected";
import { useMutation } from "react-query";
import { bonusUpdate } from "../../hooks/queries/settings";
import toast from "react-hot-toast";
import { useState } from "react";
import Card from "../../components/ui/Card";
import { getCurrencySettings } from "../../hooks/queries/settings/getCurrencySettings";

const Currency = () => {
    const { isLoading, data: currencySetting, refetch } = getCurrencySettings();

    const [myCurrency, setCurrency] = useState();

    React.useEffect(() => {
        setCurrency(currencySetting);
    }, [currencySetting]);

    const submitGenBonus = () => {
        genUpdateMutate({
            name: "mlm_currency_settings",
            value: myCurrency,
        });
    };

    const { mutate: genUpdateMutate, isLoading: isGenUpdateLoading } =
        useMutation(bonusUpdate, {
            onSuccess: (data) => {
                toast.success(data, {
                    position: "top-right",
                });
                refetch();
            },
            onError: (err) => {
                let errorobj = err?.response?.data?.data?.json_object;
                toast.error(errorobj, {
                    position: "top-right",
                });
            },
        });

    return (
        <>
            <Card>
                <div className="my-4 py-2 px-2 lg:w-1/2 border border-gray-500 mx-auto">
                    <div className="mx-2">
                        <p className="text-center py-4 text-gray-600 font-bold">
                            Set Currency settings
                        </p>
                    </div>
                    <hr />
                    <div className="my-2">
                        <div className="my-2 ">
                            <label className="block text-sm font-medium text-gray-700 pr-8">
                                Currency Name
                            </label>
                            <input
                                className="mt-1 w-full block rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                value={myCurrency?.title}
                                onChange={(e) =>
                                    setCurrency({
                                        ...myCurrency,
                                        title: e.target.value,
                                    })
                                }
                                type="text"
                            />
                        </div>
                        <div className="my-2 ">
                            <label className="block text-sm font-medium text-gray-700 pr-8">
                                Currency Symbol
                            </label>
                            <input
                                className="mt-1 w-full block rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                value={myCurrency?.icon}
                                onChange={(e) =>
                                    setCurrency({
                                        ...myCurrency,
                                        icon: e.target.value,
                                    })
                                }
                                type="text"
                            />
                        </div>
                    </div>

                    <div className="my-2">
                        {isGenUpdateLoading ? (
                            <>
                                <button
                                    className="btn btn-primary w-full flex justify-center align-center"
                                    type="button"
                                    disabled
                                >
                                    <svg
                                        className="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            className="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            strokeWidth="4"
                                        ></circle>
                                        <path
                                            className="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path>
                                    </svg>
                                    Processing ...
                                </button>
                            </>
                        ) : (
                            <button
                                onClick={submitGenBonus}
                                className="btn btn-primary w-full"
                            >
                                Save
                            </button>
                        )}
                    </div>
                </div>
            </Card>
        </>
    );
};

export default Protected(Currency);

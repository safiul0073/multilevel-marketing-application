import React from "react";
import { UseStore } from "../../../store";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import { useState } from "react";
import toast from "react-hot-toast";
import { userCreate } from "../../../hooks/queries/user";
import { useMutation } from "react-query";
import { useNavigate } from "react-router-dom";

const OrderSummary = ({ setTab, setBackendError, backendError }) => {
    const [tabIndex, setTabIndex] = useState(0);

    let navigate = useNavigate();
    const { userRegister, removeUserRegister, product } = UseStore();
    const [epin, setEpin] = useState();
    const handleEpinValue = (e) => {
        setEpin(e.target.value);
        userRegister.epin_code = e.target.value;
    };

    const handleSubmit = () => {
        createUserMutate(userRegister);
    };

    const { mutate: createUserMutate, isLoading } = useMutation(userCreate, {
        onSuccess: (data) => {
            toast.success(data, {
                position: "top-right",
            });
            removeUserRegister();
            setTimeout(() => {
                navigate("/staff/users/binary-tree");
            }, 1500);
        },
        onError: (err) => {
            let errorobj = err?.response?.data?.data?.json_object;

            setBackendError({
                ...backendError,
                ...errorobj,
            });

            if (
                errorobj?.main_sponsor_id ||
                errorobj?.refer_position ||
                errorobj?.product_id
            ) {
                setTab("sponsor");
            } else if (
                errorobj?.first_name ||
                errorobj?.last_name ||
                errorobj?.username ||
                errorobj?.email ||
                errorobj?.phone ||
                errorobj?.password
            ) {
                setTab("userInfo");
            } else if (errorobj?.epin_code) {
                toast.error(errorobj?.epin_code, {
                    position: "top-center",
                });
            } else {
                let stringMessage = err?.response?.data?.data?.string_data;
                if (stringMessage) {
                    toast.error(stringMessage, {
                        position: "top-center",
                    });
                }
                setTab("sponsor");
            }
        },
    });
    return (
        <>
            <div>
                <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table className="min-w-full divide-y divide-gray-300">
                        <thead className="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    SI No
                                </th>
                                <th
                                    scope="col"
                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Item
                                </th>
                                <th
                                    scope="col"
                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Price
                                </th>
                                <th
                                    scope="col"
                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Net Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">{1}</div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.name}
                                    </div>
                                </td>

                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.price}
                                    </div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.price}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900"></div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.name}
                                    </div>
                                </td>

                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        <span>Sub Total :</span>
                                    </div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.price}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900"></div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.name}
                                    </div>
                                </td>

                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        <span className="text-red-500">
                                            Registration Fee :
                                        </span>
                                    </div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">{0.0}</div>
                                </td>
                            </tr>
                            <tr>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900"></div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.name}
                                    </div>
                                </td>

                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        <span>Total :</span>
                                    </div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {product?.price}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <Tabs
                    className="mt-5 md:flex gap-8"
                    selectedIndex={tabIndex}
                    onSelect={(i) => setTabIndex(i)}
                >
                    <TabList className="w-44 bg-gray-300 flex md:flex-col bg-transparent gap-1">
                        <Tab
                            className={`border-none !rounded-md px-5 py-1 cursor-pointer ${
                                tabIndex == 0 ? "!bg-indigo-200 !text-black" : "!bg-gray-300"
                            }`}
                        >
                            E-Pin
                        </Tab>
                        <Tab
                            className={`border-none !rounded-md px-5 py-1 cursor-pointer ${
                                tabIndex == 1 ? "!bg-indigo-200 !text-black" : "!bg-gray-300"
                            }`}
                        >
                            Title 2
                        </Tab>
                    </TabList>

                    <TabPanel className={`w-full items-start ${
                                tabIndex == 0 ? "!flex" : "!hidden"
                            }`}>
                        <div className="mx-auto formGroup flex !flex-row !flex-wrap !gap-1 !w-full !my-0">
                            <input
                                type="text"
                                value={epin}
                                onChange={handleEpinValue}
                                className="form-control !my-0 border border-gray-700 !w-52"
                            />
                            {isLoading ? (
                                <>
                                    <button
                                        className="btn btn-primary flex justify-center items-center"
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
                                    onClick={handleSubmit}
                                    className="btn btn-primary"
                                >
                                    Submit
                                </button>
                            )}
                        </div>
                    </TabPanel>
                    <TabPanel className={`w-full items-start ${
                                tabIndex == 1 ? "!flex" : "!hidden"
                            }`}>
                        <h2>Any content 2</h2>
                    </TabPanel>
                </Tabs>

                <div className="mt-4">
                    <button
                        onClick={() => setTab("userInfo")}
                        className="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Back
                    </button>
                </div>
            </div>
        </>
    );
};

export default OrderSummary;

import React, { useState } from "react";

const Balance = () => {
    const [transferTypes, setTransferTypes] = useState([
        {
            name: "Add Balance",
            value: "add",
            active: true,
        },
        {
            name: "Subtract Balance",
            value: "sub",
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

    return (
        <form action="#" method="POST" className="mt-8 flex flex-col">
            <div className="shadow sm:overflow-hidden sm:rounded-md">
                <div className="space-y-6 bg-white py-6 px-4 sm:p-6">
                    <span className="inline-flex w-full gap-1 p-1 bg-gray-100 border-1 border-gray-300 rounded-md wide-mobile:flex-col mb-50px tablet:mb-40px wide-mobile:mb-30px">
                        {transferTypes?.map((type) => (
                            <button
                                key={Math.random()}
                                type="button"
                                className={`inline-flex grow items-center min-h-50px px-6 mobile:p-4 py-2 rounded-md font-normal focus:outline-none text-center justify-center wide-mobile:justify-start wide-mobile:shadow wide-mobile:shadow-dark/10 hover:shadow-none ${
                                    type?.active
                                        ? "bg-indigo-600 text-white"
                                        : "bg-gray-200 text-gray-800 hover:bg-gray-300"
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
                                    name="add-amount"
                                    id="add-amount"
                                    autoComplete="given-name"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
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
                                    name="sub-amount"
                                    id="sub-amount"
                                    autoComplete="given-name"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
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
                                autoComplete="given-name"
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <div className="bg-gray-50 px-4 py-3 text-right sm:px-6 flex justify-end gap-5">
                    <button
                        type="submit"
                        className="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        Cancle
                    </button>
                    <button
                        type="submit"
                        className="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    );
};

export default Balance;

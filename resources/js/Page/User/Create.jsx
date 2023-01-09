import React, { useMemo, useState, useEffect } from "react";
import Protected from "../../components/HOC/Protected";
import OrderSummary from "../../components/user/registration/OrderSummary";
import SponsorPackage from "../../components/user/registration/Sponsor&Package/Index";
import UserInfo from "../../components/user/registration/UserInfo";
import { CheckIcon } from "@heroicons/react/24/solid";

const Create = () => {
    const [tab, setTab] = useState("sponsor");
    const [steps, setSteps] = useState([
        { id: "01", name: "Sponsor", status: "current" },
        { id: "02", name: "User Info", status: "upcoming" },
        { id: "03", name: "Order Summary", status: "upcoming" },
    ]);

    useEffect(() => {
        if (tab === "sponsor") {
            setSteps([
                { id: "01", name: "Sponsor", status: "current" },
                { id: "02", name: "User Info", status: "upcoming" },
                { id: "03", name: "Order Summary", status: "upcoming" },
            ]);
        } else if (tab === "userInfo") {
            setSteps([
                { id: "01", name: "Sponsor", status: "complete" },
                { id: "02", name: "User Info", status: "current" },
                { id: "03", name: "Order Summary", status: "upcoming" },
            ]);
        } else {
            setSteps([
                { id: "01", name: "Sponsor", status: "complete" },
                { id: "02", name: "User Info", status: "complete" },
                { id: "03", name: "Order Summary", status: "current" },
            ]);
        }
    }, [tab]);

    const [backendError, setBackendError] = useState();
    const switchPage = (tab) => {
        if (tab === "sponsor") {
            return (
                <SponsorPackage backendError={backendError} setTab={setTab} />
            );
        } else if (tab === "userInfo") {
            return <UserInfo backendError={backendError} setTab={setTab} />;
        } else {
            return (
                <OrderSummary
                    setBackendError={setBackendError}
                    backendError={backendError}
                    setTab={setTab}
                />
            );
        }
    };
    const switchTab = (tab) => {
        return (
            <nav aria-label="Progress" className="mb-10 block">
                <ol
                    role="list"
                    className="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0"
                >
                    {steps.map((step, stepIdx) => (
                        <li
                            key={step.name}
                            className="relative md:flex md:flex-1"
                        >
                            {step.status === "complete" ? (
                                <button className="group flex w-full items-center">
                                    <span className="flex items-center px-6 py-4 text-sm font-medium">
                                        <span className="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600 group-hover:bg-indigo-800">
                                            <CheckIcon
                                                className="h-6 w-6 text-white"
                                                aria-hidden="true"
                                            />
                                        </span>
                                        <span className="ml-4 text-sm font-medium text-gray-900">
                                            {step.name}
                                        </span>
                                    </span>
                                </button>
                            ) : step.status === "current" ? (
                                <button
                                    className="flex items-center px-6 py-4 text-sm font-medium"
                                    aria-current="step"
                                >
                                    <span className="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-indigo-600">
                                        <span className="text-indigo-600">
                                            {step.id}
                                        </span>
                                    </span>
                                    <span className="ml-4 text-sm font-medium text-indigo-600">
                                        {step.name}
                                    </span>
                                </button>
                            ) : (
                                <button className="group flex items-center">
                                    <span className="flex items-center px-6 py-4 text-sm font-medium">
                                        <span className="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                                            <span className="text-gray-500 group-hover:text-gray-900">
                                                {step.id}
                                            </span>
                                        </span>
                                        <span className="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                            {step.name}
                                        </span>
                                    </span>
                                </button>
                            )}

                            {stepIdx !== steps.length - 1 ? (
                                <>
                                    {/* Arrow separator for lg screens and up */}
                                    <div
                                        className="absolute top-0 right-0 hidden h-full w-5 md:block"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            className="h-full w-full text-gray-300"
                                            viewBox="0 0 22 80"
                                            fill="none"
                                            preserveAspectRatio="none"
                                        >
                                            <path
                                                d="M0 -2L20 40L0 82"
                                                vectorEffect="non-scaling-stroke"
                                                stroke="currentcolor"
                                                strokeLinejoin="round"
                                            />
                                        </svg>
                                    </div>
                                </>
                            ) : null}
                        </li>
                    ))}
                </ol>
            </nav>
        );
    };
    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className=" w-2/3 h-full mx-auto">
                            {switchTab()}
                            {switchPage(tab)}
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Create);

import React from "react";
import Protected from "../components/HOC/Protected";
import {
    EnvelopeIcon,
} from "@heroicons/react/20/solid";
import CounterItems from "../components/Dashboard/CounterItems";

function classNames(...classes) {
    return classes.filter(Boolean).join(" ");
}

function Dashboard() {

    const balanceCounter = [
        {
            title: "Total Business Balance",
            initials: "BB",
            link: "#",
            count: "$345435",
            bgColor: "bg-pink-600",
        },
        {
            title: "Total Payment",
            initials: "TP",
            link: "#",
            count: "$345435",
            bgColor: "bg-purple-600",
        },
        {
            title: "Total Email Verified Users",
            initials: "EVU",
            link: "#",
            count: "$345435",
            bgColor: "bg-yellow-500",
        },
    ];

    const timePeriodCounter = [
        {
            title: "Joined User",
            period: [{ Weekly: 30 }, { Monthly: 40 }, { Yearly: 80 }],
        },
        {
            title: "Deposit Report",
            period: [{ Weekly: 30 }, { Monthly: 40 }, { Yearly: 80 }],
        },
        {
            title: "Withdraw Report",
            period: [{ Weekly: 30 }, { Monthly: 40 }, { Yearly: 80 }],
        },
    ];

    return (
        <>
        {/* <div>
            Dashboard
        </div> */}
            <div className="min-h-full">

                <div className="flex flex-1 flex-col lg:pl-64">

                    <main className="flex-1 py-8">
                        <div className="container">
                            {/* counter list */}
                            <CounterItems/>

                            <ul
                                role="list"
                                className="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3"
                            >
                                {balanceCounter.map((counter) => (
                                    <li
                                        key={Math.random()}
                                        className="col-span-1 flex rounded-md shadow-sm"
                                    >
                                        <div
                                            className={classNames(
                                                counter?.bgColor,
                                                "flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md"
                                            )}
                                        >
                                            {counter?.initials}
                                        </div>
                                        <div className="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
                                            <div className="flex-1 truncate px-4 py-2 text-sm">
                                                <a
                                                    href={counter?.href}
                                                    className="text-lg text-gray-500 "
                                                >
                                                    {counter?.title}
                                                </a>
                                                <p className="text-2xl font-medium text-gray-900">
                                                    {counter?.count}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                ))}
                            </ul>
                            <div className="grid gap-5 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-8">
                                {timePeriodCounter?.map((timePeriod) => (
                                    <div
                                        className="bg-white border border-gray-200 rounded-md p-8"
                                        key={Math.random()}
                                    >
                                        <h2 className="text-2xl font-bold tracking-tight text-gray-900 leading-none">
                                            {timePeriod?.title}
                                        </h2>
                                        <div className="mt-8 grid grid-cols-1 gap-y-5">
                                            {timePeriod?.period?.map(
                                                (count) => (
                                                    <div
                                                        key={Math.random()}
                                                        className="border-t border-gray-200 pt-4 flex justify-between items-center"
                                                    >
                                                        <span className="font-medium text-gray-500">
                                                            {
                                                                Object.keys(
                                                                    count
                                                                )[0]
                                                            }{" "}
                                                            :
                                                        </span>
                                                        <span className=" text-2xl leading-none text-gray-900">
                                                            {
                                                                Object.values(
                                                                    count
                                                                )[0]
                                                            }
                                                        </span>
                                                    </div>
                                                )
                                            )}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
}

export default Protected(Dashboard);

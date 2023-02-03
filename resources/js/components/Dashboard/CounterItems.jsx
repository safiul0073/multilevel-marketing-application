import React from "react";
import {
    EnvelopeIcon,
    UsersIcon,
    BriefcaseIcon,
    CurrencyDollarIcon,
} from "@heroicons/react/20/solid";

const CounterItems = ({data}) => {
    console.log(data)
    const counterItems = [
        {
            title: "Total Network Members",
            count: data?.total_member,
            icon: (
                <UsersIcon
                    className="h-12 w-12 text-gray-400"
                    aria-hidden="true"
                />
            ),
        },
        {
            title: "Total Package Purchase",
            count: data?.total_package_purchase,
            icon: (
                <BriefcaseIcon
                    className="h-12 w-12 text-gray-400"
                    aria-hidden="true"
                />
            ),
        },
        {
            title: "Total Members Income",
            count: data?.total_income,
            icon: (
                <CurrencyDollarIcon
                    className="h-12 w-12 text-gray-400"
                    aria-hidden="true"
                />
            ),
        },
    ];
    return (
        <>
            <ul
                role="list"
                className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
            >
                {counterItems.map((counter) => (
                    <li
                        key={Math.random()}
                        className="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow"
                    >
                        <div className="flex w-full items-center justify-between space-x-6 p-6">
                            <div className="flex-1 truncate">
                                <div className="flex items-center space-x-3">
                                    <h3 className="truncate text-base font-medium text-gray-500">
                                        {counter?.title}
                                    </h3>
                                </div>
                                <p className="mt-1 truncate text-3xl text-gray-900">
                                    {counter?.count}
                                </p>
                            </div>
                            {counter?.icon}
                        </div>
                    </li>
                ))}
            </ul>
        </>
    );
};

export default CounterItems;

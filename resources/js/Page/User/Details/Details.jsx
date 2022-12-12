import React from "react";
import { EllipsisVerticalIcon } from "@heroicons/react/20/solid";
const projects = [
    {
        name: "Total Balance",
        count: 0,
        suffix: "TK",
        initials: "TB",
        bgColor: "bg-indigo-700",
    },
    {
        name: "Total Withdraw",
        count: 0,
        suffix: "TK",
        initials: "TW",
        bgColor: "bg-rose-600",
    },
    {
        name: "Total Transaction",
        count: 0,
        suffix: "",
        initials: "TT",
        bgColor: "bg-gray-800",
    },
    {
        name: "Total Invest",
        count: 0,
        suffix: "TK",
        initials: "TI",
        bgColor: "bg-sky-500",
    },
    {
        name: "Total Referral Commission",
        count: 0,
        suffix: "TK",
        initials: "TRC",
        bgColor: "bg-indigo-900",
    },
    {
        name: "Total Matching Commission",
        count: 0,
        suffix: "TK",
        initials: "TMC",
        bgColor: "bg-indigo-500",
    },
    {
        name: "Total Generation Commission",
        count: 0,
        suffix: "TK",
        initials: "TGC",
        bgColor: "bg-indigo-600",
    },
    {
        name: "Total Left Member",
        count: 0,
        suffix: "",
        initials: "TLM",
        bgColor: "bg-gray-800",
    },
    {
        name: "Total Right Member",
        count: 0,
        suffix: "",
        initials: "TRM",
        bgColor: "bg-violet-600",
    },
];

function classNames(...classes) {
    return classes.filter(Boolean).join(" ");
}

const Details = () => {
    return (
        <>
            <ul
                role="list"
                className="mt-5 grid grid-cols-1 gap-5 md:grid-cols-3 sm:gap-6"
            >
                {projects.map((project) => (
                    <li
                        key={project.name}
                        className="col-span-1 flex rounded-md shadow-sm"
                    >
                        <div
                            className={classNames(
                                project.bgColor,
                                "flex-shrink-0 flex bg- items-center justify-center w-16 text-white text-sm font-medium rounded-l-md"
                            )}
                        >
                            {project.initials}
                        </div>
                        <div className="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
                            <div className="flex-1 truncate px-4 py-2 text-sm text-right">
                                <h3 className="text-xl font-medium text-gray-900 hover:text-gray-600">
                                    {project?.suffix
                                        ? `${project?.count} ${project?.suffix}`
                                        : project?.count}
                                </h3>
                                <p className="text-gray-500">{project.name}</p>
                            </div>
                        </div>
                    </li>
                ))}
            </ul>

            <form action="#" method="POST" className="mt-10">
                <div className="shadow sm:overflow-hidden sm:rounded-md">
                    <div className="space-y-6 bg-white py-6 px-4 sm:p-6">
                        <div>
                            <h3 className="text-lg font-medium leading-6 text-gray-900">
                                Personal Information
                            </h3>
                            <p className="mt-1 text-sm text-gray-500">
                                Use a permanent address where you can recieve
                                mail.
                            </p>
                        </div>

                        <div className="grid grid-cols-12 gap-6">
                            <div className="col-span-12 sm:col-span-6">
                                <label
                                    htmlFor="first-name"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    First name
                                </label>
                                <input
                                    type="text"
                                    name="first-name"
                                    id="first-name"
                                    autoComplete="given-name"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12 sm:col-span-6">
                                <label
                                    htmlFor="last-name"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Last name
                                </label>
                                <input
                                    type="text"
                                    name="last-name"
                                    id="last-name"
                                    autoComplete="family-name"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12 sm:col-span-6">
                                <label
                                    htmlFor="email-address"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    User Name
                                </label>
                                <input
                                    type="text"
                                    name="email-address"
                                    id="email-address"
                                    autoComplete="email"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12 sm:col-span-6">
                                <label
                                    htmlFor="email-address"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Email address
                                </label>
                                <input
                                    type="text"
                                    name="email-address"
                                    id="email-address"
                                    autoComplete="email"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12">
                                <label
                                    htmlFor="street-address"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Street address
                                </label>
                                <input
                                    type="text"
                                    name="street-address"
                                    id="street-address"
                                    autoComplete="street-address"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12 sm:col-span-6 lg:col-span-3">
                                <label
                                    htmlFor="city"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    City
                                </label>
                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    autoComplete="address-level2"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12 sm:col-span-6 lg:col-span-3">
                                <label
                                    htmlFor="region"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    State / Province
                                </label>
                                <input
                                    type="text"
                                    name="region"
                                    id="region"
                                    autoComplete="address-level1"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12 sm:col-span-6 lg:col-span-3">
                                <label
                                    htmlFor="postal-code"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    ZIP / Postal code
                                </label>
                                <input
                                    type="text"
                                    name="postal-code"
                                    id="postal-code"
                                    autoComplete="postal-code"
                                    className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                            </div>

                            <div className="col-span-12 sm:col-span-6 lg:col-span-3">
                                <label
                                    htmlFor="country"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Country
                                </label>
                                <select
                                    id="country"
                                    name="country"
                                    autoComplete="country-name"
                                    className="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                >
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                            </div>

                            <div className="col-span-12 md:col-span-4">
                                <label
                                    htmlFor="country"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Status
                                </label>
                                <div className="mt-1 flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Active
                                </div>
                            </div>

                            <div className="col-span-12 md:col-span-4">
                                <label
                                    htmlFor="country"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    Email Verification
                                </label>
                                <div className="mt-1 flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Verified
                                </div>
                            </div>
                            <div className="col-span-12 md:col-span-4">
                                <label
                                    htmlFor="country"
                                    className="block text-sm font-medium text-gray-700"
                                >
                                    SMS Verification
                                </label>
                                <div className="mt-1 flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Verified
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </>
    );
};

export default Details;

import React, { useState } from "react";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import { ArrowLeftIcon } from "@heroicons/react/24/outline";
import "react-tabs/style/react-tabs.css";
import Details from "./Details";
import Balance from "./Balance";
import LoginLog from "./LoginLog";
import SendEmail from "./SendEmail";
import Password from "./Password";
import Referrals from "./Referrals";

const tabOptions = [
    {
        title: "User Profile",
        placeholder: "Profile",
        colorClass: "bg-blue-600 hover:bg-blue-700 focus:ring-blue-500",
        isTab: true,
        content: (
            <>
                <Details />
            </>
        ),
    },
    {
        title: "Add or Subtract Balance",
        placeholder: "Add/Subtract Balance",
        colorClass: "bg-green-600 hover:bg-green-700 focus:ring-green-500",
        isTab: true,
        content: (
            <>
                <Balance />
            </>
        ),
    },
    {
        title: "User Login Logs",
        placeholder: "Login Logs",
        colorClass: "bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500",
        isTab: true,
        content: (
            <>
                <LoginLog />
            </>
        ),
    },
    {
        title: "Send Email to User",
        placeholder: "Send Email",
        colorClass: "bg-sky-600 hover:bg-sky-600 focus:ring-sky-600",
        isTab: true,
        content: (
            <>
                <SendEmail />
            </>
        ),
    },
    {
        title: "Login as User",
        placeholder: "Login as User",
        isTab: false,
        colorClass: "bg-gray-900 hover:bg-gray-900 focus:ring-gray-900",
        link: "https://www.google.com",
    },
    {
        title: "Change User Password!",
        placeholder: "Password Change",
        colorClass: "bg-sky-600 hover:bg-sky-600 focus:ring-sky-600",
        isTab: true,
        content: (
            <>
                <Password />
            </>
        ),
    },
    {
        title: "User Referrals List",
        placeholder: "User Referrals",
        colorClass: "bg-orange-600 hover:bg-orange-600 focus:ring-orange-600",
        isTab: true,
        content: (
            <>
                <Referrals />
            </>
        ),
    },
    {
        title: "User Referrals Tree",
        placeholder: "User Tree",
        colorClass: "bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500",
        isTab: true,
        content: (
            <>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. At
                repellat corrupti, facere, qui eius optio veniam enim animi nam
                incidunt illo? Consectetur nemo dolor excepturi laborum omnis
                quae veniam ad.
            </>
        ),
    },
];

export default function UserDetails({ showUserDetails, setUserDetails }) {
    const [tabIndex, setTabIndex] = useState(0);
    const handleTab = (index) => {
        setTabIndex(index);
    };

    return (
        <>
            <Tabs
                selectedIndex={tabIndex}
                onSelect={(index) => handleTab(index)}
                className="container md:flex gap-8"
            >
                <TabList className="w-44 bg-gray-300 screen basis-[250px] shrink-0 p-5 gap-2.5 flex md:flex-col">
                    <div className="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow mb-2">
                        <div className="flex flex-1 flex-col p-8">
                            <img
                                className="mx-auto h-32 w-32 flex-shrink-0 rounded-full"
                                src="https://via.placeholder.com/150"
                                alt=""
                            />
                            <h3 className="mt-6 text-sm font-medium text-gray-900">
                                Sapan Mozammel
                            </h3>
                            <dl className="mt-1 flex flex-grow flex-col justify-between">
                                <dt className="sr-only">Title</dt>
                                <dd className="text-sm text-gray-500">
                                    Frontend Developer
                                </dd>
                            </dl>
                        </div>
                    </div>
                    {tabOptions?.map((tabLink) => {
                        return (
                            <React.Fragment key={Math.random()}>
                                {tabLink?.isTab ? (
                                    <Tab
                                        className="betterdocs-analytics-tab-item w-full"
                                        selectedClassName="active"
                                    >
                                        <button
                                            type="button"
                                            className={`inline-flex items-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 w-full ${tabLink?.colorClass}`}
                                        >
                                            {tabLink?.placeholder}
                                        </button>
                                    </Tab>
                                ) : (
                                    <a
                                        href={tabLink?.link}
                                        className={`inline-flex items-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 w-full ${tabLink?.colorClass}`}
                                    >
                                        {tabLink?.placeholder}
                                    </a>
                                )}
                            </React.Fragment>
                        );
                    })}
                </TabList>
                <div className="flex flex-col grow">
                    <div className="sm:flex sm:items-center">
                        <div className="sm:flex-auto flex items-center">
                            <button
                                className="inline-flex items-center rounded border border-transparent bg-gray-200 p-1.5 text-black shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 mr-2"
                                onClick={() => setUserDetails(false)}
                            >
                                <ArrowLeftIcon
                                    className="h-5 w-5"
                                    aria-hidden="true"
                                />
                            </button>
                            <h1 className="text-xl font-semibold text-gray-900">
                                {
                                    tabOptions.filter((option) => option.isTab)[
                                        tabIndex
                                    ]?.title
                                }
                            </h1>
                        </div>
                    </div>

                    {tabOptions?.map((tabContent) => {
                        return (
                            <React.Fragment key={Math.random()}>
                                {tabContent?.isTab ? (
                                    <TabPanel>
                                        <div>{tabContent?.content}</div>
                                    </TabPanel>
                                ) : null}
                            </React.Fragment>
                        );
                    })}
                </div>
            </Tabs>
        </>
    );
}

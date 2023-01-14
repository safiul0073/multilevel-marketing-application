import React, { useState } from "react";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import { ArrowLeftIcon } from "@heroicons/react/24/outline";
import { userDetails } from "../../../hooks/queries/user/userDetails";
import "react-tabs/style/react-tabs.css";
import Details from "./Details";
import Balance from "./Balance";
import LoginLog from "./LoginLog";
import SendEmail from "./SendEmail";
import Password from "./Password";
import Referrals from "./Referrals";
import moment from "moment";
import { LIVE_URL } from "../../../constent";
import ReferralTree from "./ReferralTree";

export default function UserDetails({ showUserDetails, setUserDetails }) {
    const { data: details, refetch: detailsRefetch } = userDetails({
        id: showUserDetails?.id,
    });
    const tabOptions = [
        {
            title: "User Profile",
            placeholder: "Profile",
            colorClass: "bg-blue-600 hover:bg-blue-700 focus:ring-blue-500",
            isTab: true,
            content: (
                <>
                    <Details
                        details={details}
                        detailsRefetch={detailsRefetch}
                    />
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
                    <Balance id={showUserDetails?.id} detailsRefetch={detailsRefetch} />
                </>
            ),
        },
        {
            title: "User Login Logs",
            placeholder: "Login Logs",
            colorClass:
                "bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500",
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
            link: `${LIVE_URL}user-login/${showUserDetails?.id}`,
        },
        {
            title: "Change User Password!",
            placeholder: "Password Change",
            colorClass: "bg-sky-600 hover:bg-sky-600 focus:ring-sky-600",
            isTab: true,
            content: (
                <>
                    <Password userId={showUserDetails?.id} />
                </>
            ),
        },
        {
            title: "User Referrals List",
            placeholder: "User Referrals",
            colorClass:
                "bg-orange-600 hover:bg-orange-600 focus:ring-orange-600",
            isTab: true,
            content: (
                <>
                    <Referrals id={showUserDetails?.id} />
                </>
            ),
        },
        {
            title: "User Referrals Tree",
            placeholder: "User Tree",
            colorClass:
                "bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500",
            isTab: true,
            content: (
                <>
                    <ReferralTree username={showUserDetails?.username} />
                </>
            ),
        },
    ];
    const [tabIndex, setTabIndex] = useState(0);
    const handleTab = (index) => {
        setTabIndex(index);
    };

    return (
        <>
            <Tabs
                selectedIndex={tabIndex}
                onSelect={(index) => handleTab(index)}
                className="container flex flex-col md:flex-row gap-8"
            >
                <div className="bg-gray-300 screen basis-full md:basis-[250px] shrink-0 p-5 gap-2.5 flex md:flex-col">
                    <div className="col-span-1 shrink-0 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                        <div className="flex flex-1 flex-col p-8">
                            <img
                                className="mx-auto h-32 w-32 flex-shrink-0 rounded-full"
                                src={
                                    details?.image
                                        ? details?.image?.url
                                        : "https://via.placeholder.com/150"
                                }
                                alt=""
                            />
                            <h3 className="mt-6 text-sm font-medium text-gray-900">
                                {showUserDetails?.first_name +
                                    " " +
                                    (showUserDetails?.last_name ?? "")}
                            </h3>
                            <dl className="mt-1 flex flex-grow flex-col justify-between">
                                <dt className="sr-only">Title</dt>
                                <dd className="text-[10px] text-gray-500">
                                    Joined At:{" "}
                                    <span className="text-gray-900">
                                        {moment(
                                            showUserDetails?.created_at
                                        ).format("d MMM, Y h:mm a ")}
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <TabList className="flex flex-row flex-wrap md:flex-col gap-2.5 items-end content-end">
                        {tabOptions?.map((tabLink) => {
                            return (
                                <React.Fragment key={Math.random()}>
                                    {tabLink?.isTab ? (
                                        <Tab
                                            className="betterdocs-analytics-tab-item md:w-full"
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
                                            className={`inline-flex items-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 md:w-full ${tabLink?.colorClass}`}
                                        >
                                            {tabLink?.placeholder}
                                        </a>
                                    )}
                                </React.Fragment>
                            );
                        })}
                    </TabList>
                </div>
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

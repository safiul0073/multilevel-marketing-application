import React, { useState, Fragment } from "react";
import { Dialog, Menu, Transition } from "@headlessui/react";
import { Logout } from "../helper/functions";
import { getLoggedOut } from "../hooks/queries/auth/auth";
import { useNavigate } from "react-router-dom";
import { UseStore } from "../store";
import Protected from "../components/HOC/Protected";
import {
    Bars3CenterLeftIcon,
    BellIcon,
    ClockIcon,
    CreditCardIcon,
    HomeIcon,
    ScaleIcon,
    XMarkIcon,
} from "@heroicons/react/24/outline";
import {
    EnvelopeIcon,
    ChevronDownIcon,
    MagnifyingGlassIcon,
} from "@heroicons/react/20/solid";

function classNames(...classes) {
    return classes.filter(Boolean).join(" ");
}

function Dashboard() {
    const store = UseStore();

    const [sidebarOpen, setSidebarOpen] = useState(false);

    let navigate = useNavigate();

    const logoutOption = () => {
        getLoggedOut();
        Logout();
        store.removeUser()
        store.removeAuth()
        navigate("/staff/login");
    };

    const navigation = [
        { name: "Dashboard", href: "#", icon: HomeIcon, current: true },
        { name: "Category", href: "#", icon: ClockIcon, current: false },
        { name: "MLM Plans", href: "#", icon: ScaleIcon, current: false },
        { name: "Network", href: "#", icon: CreditCardIcon, current: false },
    ];

    const counterItems = [
        {
            title: "Total Network Members",
            count: 20,
            link: "https://www.google.com",
            icon: (
                <EnvelopeIcon
                    className="h-12 w-12 text-gray-400"
                    aria-hidden="true"
                />
            ),
        },
        {
            title: "Total Package Purchase",
            count: 33,
            link: "https://www.google.com",
            icon: (
                <EnvelopeIcon
                    className="h-12 w-12 text-gray-400"
                    aria-hidden="true"
                />
            ),
        },
        {
            title: "Total Members Income",
            count: "$2040.33",
            link: "https://www.google.com",
            icon: (
                <EnvelopeIcon
                    className="h-12 w-12 text-gray-400"
                    aria-hidden="true"
                />
            ),
        },
    ];

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
            <div className="min-h-full">
                {/* <Transition.Root show={sidebarOpen} as={Fragment}>
                    <Dialog
                        as="div"
                        className="relative z-40 lg:hidden"
                        onClose={setSidebarOpen}
                    >
                        <Transition.Child
                            as={Fragment}
                            enter="transition-opacity ease-linear duration-300"
                            enterFrom="opacity-0"
                            enterTo="opacity-100"
                            leave="transition-opacity ease-linear duration-300"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0"
                        >
                            <div className="fixed inset-0 bg-gray-600 bg-opacity-75" />
                        </Transition.Child>

                        <div className="fixed inset-0 z-40 flex">
                            <Transition.Child
                                as={Fragment}
                                enter="transition ease-in-out duration-300 transform"
                                enterFrom="-translate-x-full"
                                enterTo="translate-x-0"
                                leave="transition ease-in-out duration-300 transform"
                                leaveFrom="translate-x-0"
                                leaveTo="-translate-x-full"
                            >
                                <Dialog.Panel className="relative flex w-full max-w-xs flex-1 flex-col bg-cyan-700 pt-5 pb-4">
                                    <Transition.Child
                                        as={Fragment}
                                        enter="ease-in-out duration-300"
                                        enterFrom="opacity-0"
                                        enterTo="opacity-100"
                                        leave="ease-in-out duration-300"
                                        leaveFrom="opacity-100"
                                        leaveTo="opacity-0"
                                    >
                                        <div className="absolute top-0 right-0 -mr-12 pt-2">
                                            <button
                                                type="button"
                                                className="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                                onClick={() =>
                                                    setSidebarOpen(false)
                                                }
                                            >
                                                <XMarkIcon
                                                    className="h-6 w-6 text-white"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </Transition.Child>
                                    <div className="flex flex-shrink-0 items-center px-4">
                                        <img
                                            className="h-8 w-auto"
                                            src="https://tailwindui.com/img/logos/mark.svg?color=cyan&shade=300"
                                            alt="Easywire logo"
                                        />
                                    </div>
                                    <nav
                                        className="mt-5 h-full flex-shrink-0 divide-y divide-cyan-800 overflow-y-auto"
                                        aria-label="Sidebar"
                                    >
                                        <div className="space-y-1 px-2">
                                            {navigation.map((item) => (
                                                <a
                                                    key={item.name}
                                                    href={item.href}
                                                    className={classNames(
                                                        item.current
                                                            ? "bg-cyan-800 text-white"
                                                            : "text-cyan-100 hover:text-white hover:bg-cyan-600",
                                                        "group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                                    )}
                                                    aria-current={
                                                        item.current
                                                            ? "page"
                                                            : undefined
                                                    }
                                                >
                                                    <item.icon
                                                        className="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                                        aria-hidden="true"
                                                    />
                                                    {item.name}
                                                </a>
                                            ))}
                                        </div>
                                    </nav>
                                </Dialog.Panel>
                            </Transition.Child>
                            <div
                                className="w-14 flex-shrink-0"
                                aria-hidden="true"
                            ></div>
                        </div>
                    </Dialog>
                </Transition.Root> */}

                {/* <div className="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
                    <div className="flex flex-grow flex-col overflow-y-auto bg-indigo-800 pt-5 pb-4">
                        <div className="flex flex-shrink-0 items-center px-4">
                            <img
                                className="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=cyan&shade=300"
                                alt="Easywire logo"
                            />
                        </div>
                        <div className="mt-5 px-3">
                            <label htmlFor="search" className="sr-only">
                                Search
                            </label>
                            <div className="relative mt-1 rounded-md shadow-sm">
                                <div
                                    className="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                    aria-hidden="true"
                                >
                                    <MagnifyingGlassIcon
                                        className="mr-3 h-4 w-4 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </div>
                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    className="h-10 block w-full rounded-md border-gray-300 pl-9 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Search"
                                />
                            </div>
                        </div>
                        <nav
                            className="mt-5 flex flex-1 flex-col divide-y divide-cyan-800 overflow-y-auto"
                            aria-label="Sidebar"
                        >
                            <div className="space-y-1 px-2">
                                {navigation.map((item) => (
                                    <a
                                        key={item.name}
                                        href={item.href}
                                        className={classNames(
                                            item.current
                                                ? "bg-indigo-600 text-white"
                                                : "text-gray-100 hover:text-white hover:bg-indigo-600",
                                            "group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                                        )}
                                        aria-current={
                                            item.current ? "page" : undefined
                                        }
                                    >
                                        <item.icon
                                            className="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200"
                                            aria-hidden="true"
                                        />
                                        {item.name}
                                    </a>
                                ))}
                            </div>
                        </nav>
                    </div>
                </div> */}

                <div className="flex flex-1 flex-col lg:pl-64">
                    <div className="flex h-16 flex-shrink-0 border-b border-gray-200 bg-white">
                        <button
                            type="button"
                            className="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden"
                            onClick={() => setSidebarOpen(true)}
                        >
                            <span className="sr-only">Open sidebar</span>
                            <Bars3CenterLeftIcon
                                className="h-6 w-6"
                                aria-hidden="true"
                            />
                        </button>
                        <div className="flex flex-1 justify-between container">
                            <h2 className="hidden lg:inline-flex items-center text-lg font-medium leading-6 text-gray-900 lg:truncate">
                                {navigation.find((item) => item?.current)?.name}
                            </h2>
                            <div className="flex flex-1 lg:hidden">
                                <form
                                    className="flex w-full md:ml-0"
                                    action="#"
                                    method="GET"
                                >
                                    <label
                                        htmlFor="search-field"
                                        className="sr-only"
                                    >
                                        Search
                                    </label>
                                    <div className="relative w-full text-gray-400 focus-within:text-gray-600">
                                        <div
                                            className="pointer-events-none absolute inset-y-0 left-0 flex items-center"
                                            aria-hidden="true"
                                        >
                                            <MagnifyingGlassIcon
                                                className="h-5 w-5"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <input
                                            id="search-field"
                                            name="search-field"
                                            className="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                                            placeholder="Search transactions"
                                            type="search"
                                        />
                                    </div>
                                </form>
                            </div>
                            <div className="ml-4 flex items-center md:ml-6">
                                <button
                                    type="button"
                                    className="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"
                                >
                                    <span className="sr-only">
                                        View notifications
                                    </span>
                                    <BellIcon
                                        className="h-6 w-6"
                                        aria-hidden="true"
                                    />
                                </button>

                                {/* Profile dropdown */}
                                <Menu as="div" className="relative ml-3">
                                    <div>
                                        <Menu.Button className="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 lg:rounded-md lg:p-2 lg:hover:bg-gray-50">
                                            <img
                                                className="h-8 w-8 rounded-full"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                alt=""
                                            />
                                            <span className="ml-3 hidden text-sm font-medium text-gray-700 lg:block">
                                                <span className="sr-only">
                                                    Open user menu for{" "}
                                                </span>
                                                Emilia Birch
                                            </span>
                                            <ChevronDownIcon
                                                className="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block"
                                                aria-hidden="true"
                                            />
                                        </Menu.Button>
                                    </div>
                                    <Transition
                                        as={Fragment}
                                        enter="transition ease-out duration-100"
                                        enterFrom="transform opacity-0 scale-95"
                                        enterTo="transform opacity-100 scale-100"
                                        leave="transition ease-in duration-75"
                                        leaveFrom="transform opacity-100 scale-100"
                                        leaveTo="transform opacity-0 scale-95"
                                    >
                                        <Menu.Items className="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <Menu.Item>
                                                {({ active }) => (
                                                    <a
                                                        href="#"
                                                        className={classNames(
                                                            active
                                                                ? "bg-gray-100"
                                                                : "",
                                                            "block px-4 py-2 text-sm text-gray-700"
                                                        )}
                                                    >
                                                        Your Profile
                                                    </a>
                                                )}
                                            </Menu.Item>
                                            <Menu.Item>
                                                {({ active }) => (
                                                    <a
                                                        href="#"
                                                        className={classNames(
                                                            active
                                                                ? "bg-gray-100"
                                                                : "",
                                                            "block px-4 py-2 text-sm text-gray-700"
                                                        )}
                                                    >
                                                        Settings
                                                    </a>
                                                )}
                                            </Menu.Item>
                                            <Menu.Item>
                                                {({ active }) => (
                                                    <button
                                                        onClick={logoutOption}
                                                        className={classNames(
                                                            active
                                                                ? "bg-gray-100"
                                                                : "",
                                                            "block px-4 py-2 text-sm text-gray-700"
                                                        )}
                                                    >
                                                        Logout
                                                    </button>
                                                )}
                                            </Menu.Item>
                                        </Menu.Items>
                                    </Transition>
                                </Menu>
                            </div>
                        </div>
                    </div>
                    <main className="flex-1 py-8">
                        <div className="container">
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
                                        <div className="flex px-6 py-1.5 justify-end items-center">
                                            <a
                                                href={counter?.link}
                                                type="button"
                                                className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            >
                                                View All
                                            </a>
                                        </div>
                                    </li>
                                ))}
                            </ul>

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

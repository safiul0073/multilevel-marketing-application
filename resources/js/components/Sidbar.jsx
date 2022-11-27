import { Dialog, Transition } from '@headlessui/react'
import React, { Fragment, useState } from 'react'
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
export const Sidbar = () => {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const navigation = [
        { name: "Dashboard", href: "#", icon: HomeIcon, current: true },
        { name: "Category", href: "#", icon: ClockIcon, current: false },
        { name: "MLM Plans", href: "#", icon: ScaleIcon, current: false },
        { name: "Network", href: "#", icon: CreditCardIcon, current: false },
    ];
  return (
    <div>
                <Transition.Root show={sidebarOpen} as={Fragment}>
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
                </Transition.Root>

                <div className="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
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
                </div>

    </div>
  )
}

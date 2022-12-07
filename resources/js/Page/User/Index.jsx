import moment from "moment";
import React, { useMemo, useState } from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Protected from "../../components/HOC/Protected";
import { getAllUser } from "../../hooks/queries/user/getAllUser";


const Index = () => {

    // fetching category list using react query
    const {data:users, isLoading, refetch} = getAllUser()

    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="sm:flex sm:items-center">
                                <div className="sm:flex-auto">
                                    <h1 className="text-xl font-semibold text-gray-900">
                                        User List
                                    </h1>
                                </div>
                                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                    <button
                                        type="button"
                                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                        onClick={() => createCategory()}
                                    >
                                        Add New Category
                                    </button>
                                </div>
                            </div>
                            <div className="mt-8 flex flex-col">
                                {isLoading ?
                                    <LoaderAnimation/>
                                    :
                                <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                        <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                            <table className="min-w-full divide-y divide-gray-300">
                                                <thead className="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            className="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6"
                                                        >
                                                            User
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-center text-sm font-semibold text-gray-900"
                                                        >
                                                            Sponser Id
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-center text-sm font-semibold text-gray-900"
                                                        >
                                                            Email-Phone
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-center text-sm font-semibold text-gray-900"
                                                        >
                                                            Country
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-center text-sm font-semibold text-gray-900"
                                                        >
                                                            Joined At
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-center text-sm font-semibold text-gray-900"
                                                        >
                                                            Balance
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            className="relative py-3.5 pl-3 pr-4 sm:pr-6 text-center "
                                                        >
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody className="divide-y divide-gray-200 bg-white">
                                                    {users && users?.data?.map(
                                                        (user) => (
                                                            <tr
                                                                key={Math.random()}
                                                            >
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    <div className=" text-center">
                                                                        <div>{user?.first_name + " " + user?.last_name}</div>
                                                                        <div>{user?.username}</div>
                                                                    </div>
                                                                </td>
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    <div className="text-center">
                                                                        {user?.sponsor?.username}
                                                                    </div>
                                                                </td>
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    <div className=" text-center">
                                                                        <div>{user?.email}</div>
                                                                        <div>{user?.phone}</div>
                                                                    </div>
                                                                </td>
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    <div className="text-center">
                                                                        {user?.country}
                                                                    </div>
                                                                </td>
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    <div className=" text-center">
                                                                        <div>{moment(user?.created_at).format('MMMM Do YYYY, h:mm:ss a')}</div>
                                                                        <div>{moment(user?.created_at).fromNow()}</div>
                                                                    </div>
                                                                </td>
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    <div className="text-center">
                                                                        {user?.balance}
                                                                    </div>
                                                                </td>
                                                                <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                    <div className="flex gap-2 justify-end">
                                                                        <button
                                                                            className="text-indigo-600 font-normal hover:text-indigo-700 hover:underline"

                                                                        >
                                                                            Edit
                                                                        </button>
                                                                        <button
                                                                            className="text-red-600 font-normal hover:text-red-700 hover:underline"

                                                                        >
                                                                            Delete
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        )
                                                    )}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                    }
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Index);

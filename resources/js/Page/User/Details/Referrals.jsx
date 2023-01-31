import moment from "moment";
import React from "react";
import LoaderAnimation from "../../../components/common/LoaderAnimation";
import Pagination from "../../../components/common/Pagination";
import RowNotFound from "../../../components/common/RowNotFound";
import { getUserReferrals } from "../../../hooks/queries/user/getUserReferrals";

const Referrals = ({id}) => {
    const [page, setPage] = React.useState(1)
    const [pageSize, setPageSize] = React.useState(10)

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum)
        setPageSize(() => currentPageValue)
    }
    const {data: peoples, isLoading} = getUserReferrals(id, page, pageSize)
    return (
        <div className="mt-10">
            {/* <div className="sm:flex sm:items-center">
                <div className="sm:flex-auto">
                    <h1 className="text-xl font-semibold text-gray-900">
                        Users
                    </h1>
                    <p className="mt-2 text-sm text-gray-700">
                        A list of all the users in your account including their
                        name, title, email and role.
                    </p>
                </div>
                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        type="button"
                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >
                        Add user
                    </button>
                </div>
            </div> */}
            <div className="mt-8 flex flex-col">
                <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                    {isLoading ? (
                        <LoaderAnimation />
                    ) : (
                        <>
                            {peoples?.data?.length ? (
                        <>
                        <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table className="min-w-full divide-y divide-gray-300">
                                <thead className="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                        >
                                            Name
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Email
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Phone
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Username
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Joined At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-200 bg-white">
                                    {peoples?.data?.map((person) => (
                                        <tr key={Math.random()}>
                                            <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {person?.bonus_for?.first_name + ' ' + person?.bonus_for?.last_name?? ''}
                                            </td>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {person?.bonus_for?.email}
                                            </td>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {person?.bonus_for?.phone}
                                            </td>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {person?.bonus_for?.username}
                                            </td>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {moment(
                                                    person?.bonus_for?.created_at
                                                ).format(
                                                    "MMMM Do YYYY"
                                                )}
                                            </td>

                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                        <div className="my-4">
                            <Pagination
                                total={peoples?.total}
                                pageSize={pageSize}
                                pageNumber={page}
                                handlePageChange={handlePageChange}
                            />
                        </div>
                        </>
                           ): (
                            <RowNotFound name='referrals' />
                        )}
                        </>
                    )}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Referrals;

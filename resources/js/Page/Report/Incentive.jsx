import moment from "moment";
import React from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import { getIncentiveBonus } from "../../hooks/queries/bonus/getIncentiveBonus";

const Incentive = () => {
    const [page, setPage] = React.useState(1)
    const [pageSize, setPageSize] = React.useState(10)

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum)
        setPageSize(() => currentPageValue)
    }
    const {data: incentives, isLoading} = getIncentiveBonus({
        from_date: '',
        to_date: '',
        page: page,
        perPage: pageSize
    })
    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                        <div className="mt-8 flex flex-col">
                            <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                                {isLoading ? (
                                    <LoaderAnimation />
                                ) : (
                                    <>
                                        {incentives?.data?.length ? (
                                    <>
                                    <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table className="min-w-full divide-y divide-gray-300">
                                            <thead className="bg-gray-50">
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                    >
                                                        ID
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        From Date
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        To Date
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Members
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Amount
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Given Date
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody className="divide-y divide-gray-200 bg-white">
                                                {incentives?.data?.map((incentive) => (
                                                    <tr key={Math.random()}>
                                                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                            {incentive?.id}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {incentive?.from_date}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {incentive?.to_date}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {incentive?.count}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {incentive?.amount}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            <div>
                                                                {moment(
                                                                    incentive?.created_at
                                                                ).format(
                                                                    "MMMM Do YYYY, h:mm:ss a"
                                                                )}
                                                            </div>
                                                            <div>
                                                                {moment(
                                                                    incentive?.created_at
                                                                ).fromNow()}
                                                            </div>
                                                        </td>

                                                    </tr>
                                                ))}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div className="my-4">
                                        <Pagination
                                            total={incentives?.total}
                                            pageSize={pageSize}
                                            pageNumber={page}
                                            handlePageChange={handlePageChange}
                                        />
                                    </div>
                                    </>
                                    ): (
                                        <RowNotFound name='incentives' />
                                    )}
                                    </>
                                )}
                                </div>
                            </div>
                        </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Incentive);

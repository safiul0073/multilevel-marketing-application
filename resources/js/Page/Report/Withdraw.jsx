import moment from "moment";
import React from "react";
import toast from "react-hot-toast";
import { useMutation } from "react-query";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import { confirmWithdraw } from "../../hooks/queries/withdraw";
import { getWithdraws } from "../../hooks/queries/withdraw/getWithdraws";

const Withdraw = () => {
    const [page, setPage] = React.useState(1)
    const [pageSize, setPageSize] = React.useState(10)
    const [status, setStatus] = React.useState('all')
    const [confirmLoadingId, setConfirmLoading] = React.useState()
    const [cancelLoadingId, setCancelLoading] = React.useState()

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum)
        setPageSize(() => currentPageValue)
    }

    const {data: withdraws, isLoading, refetch} = getWithdraws({
        from_date: '',
        to_date: '',
        status: status,
        page: page,
        perPage: pageSize
    })

    const confirmWithdrawAction = (withdraw) => {
        confirmMutate({
            ids: withdraw?.id,
            status: 1
        })
        setConfirmLoading(withdraw?.id)
    }
    const cancelWithdrawAction = (withdraw) => {
        confirmMutate({
            ids: withdraw?.id,
            status: 2
        })
        setCancelLoading(withdraw?.id)
    }
    const {
        mutate: confirmMutate,
        isLoading: confirmLoading
      } = useMutation(confirmWithdraw, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            refetch()
        },
        onError: (err) => {
            console.log(err)
        },
      });
    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                        <div className="sm:flex sm:items-center">
                                <div className="flex gap-3">
                                    <button
                                        onClick={() => setStatus('all')}
                                        className={status == 'all' ? "btn btn-secondary" : "btn btn-primary"}>All</button>
                                    <button onClick={() => setStatus(0)} className={status == 0 ? "btn btn-secondary" : "btn btn-warning"}>Pending</button>
                                    <button onClick={() => setStatus(1)} className={status == 1 ? "btn btn-secondary" : "btn btn-success"}>Confirmed</button>
                                    <button onClick={() => setStatus(2)} className={status == 2 ? "btn btn-secondary" : "btn btn-danger"}>Cancelled</button>
                                </div>

                            </div>
                        <div className="mt-8 flex flex-col">
                                        <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                                {isLoading ? (
                                    <LoaderAnimation />
                                ) : (
                                    <>
                                        {withdraws?.data?.length ? (
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
                                                        User
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Method
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Account
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Charge
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
                                                        Status
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Requested At
                                                    </th>
                                                    {
                                                        status == 'all' || status == 0 ?
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                        >
                                                            Action
                                                        </th>
                                                        :
                                                        ""
                                                    }
                                                </tr>
                                            </thead>
                                            <tbody className="divide-y divide-gray-200 bg-white">
                                                {withdraws?.data?.map((withdraw) => (
                                                    <tr key={Math.random()}>
                                                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                            {withdraw?.id}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {withdraw?.user?.username}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {withdraw?.method_name}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {withdraw?.account_number}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {withdraw?.charge}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {withdraw?.amount}
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {  !withdraw?.status
                                                                ?
                                                                <span className="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                                                                :
                                                                withdraw?.status == 1
                                                                ?
                                                                <span className="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Confirmed</span>
                                                                :
                                                                <span className="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Cancelled</span>
                                                            }
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            <div>
                                                                {moment(
                                                                    withdraw?.created_at
                                                                ).format(
                                                                    "MM-DD-YYYY, h:mm a"
                                                                )}
                                                            </div>
                                                            <div>
                                                                {moment(
                                                                    withdraw?.created_at
                                                                ).fromNow()}
                                                            </div>
                                                        </td>
                                                        {
                                                            (status == 'all' || status == 0) && withdraw?.status == 0
                                                            ?
                                                                <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                <div className="flex gap-2 justify-end">
                                                                    {
                                                                        confirmLoading && confirmLoadingId == withdraw?.id ?
                                                                        <>
                                                                            <button className="text-sky-600 font-normal hover:text-sky-700 hover:underline" type="button" disabled>
                                                                                <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                                                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                            </svg>
                                                                            Processing ...
                                                                            </button>
                                                                        </>
                                                                        :
                                                                        <button
                                                                            className="text-sky-600 font-normal hover:text-sky-700 hover:underline"
                                                                            onClick={() => confirmWithdrawAction(withdraw)}
                                                                        >
                                                                            Confirm
                                                                        </button>
                                                                    }

                                                                   {
                                                                        confirmLoading && cancelLoadingId == withdraw?.id ?
                                                                        <>
                                                                            <button className="text-red-600 font-normal hover:text-sky-700 hover:underline" type="button" disabled>
                                                                                <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                                                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                            </svg>
                                                                            Processing ...
                                                                            </button>
                                                                        </>
                                                                        :
                                                                        <button
                                                                            className="text-red-600 font-normal hover:text-red-700 hover:underline"
                                                                            onClick={() => cancelWithdrawAction(withdraw)}
                                                                        >
                                                                            Cancel
                                                                        </button>
                                                                    }

                                                                </div>
                                                            </td>
                                                            :
                                                            ""
                                                        }
                                                    </tr>
                                                ))}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div className="my-4">
                                        <Pagination
                                            total={withdraws?.total}
                                            pageSize={pageSize}
                                            pageNumber={page}
                                            handlePageChange={handlePageChange}
                                        />
                                    </div>
                                    </>
                                    ): (
                                        <RowNotFound name='withdraws' />
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

export default Protected(Withdraw);

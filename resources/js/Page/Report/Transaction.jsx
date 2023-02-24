import moment from "moment";
import React from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import { getTransactions } from "../../hooks/queries/reports/getTransactions";

const transactionType = [
    {
        style: "bg-blue-500 text-white hover:bg-blue-600",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: true,
        name: "All",
        type: "all"
    },
    {
        style: "bg-red-500 text-white hover:bg-red-600",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: false,
        name: "Death",
        type: "death"
    },
    {
        style: "bg-green-700 text-white hover:bg-green-600",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: false,
        name: "Gift",
        type: "gift"
    },
    {
        style: "bg-emerald-400 text-white hover:bg-emerald-600",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: false,
        name: "Subtraction",
        type: "sub"
    },
    {
        style: "bg-gray-300 text-gray-800 hover:bg-gray-400",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: false,
        name: "Education",
        type: "education"
    },
    {
        style: "bg-orange-200 text-gray-800 hover:bg-orange-300",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: false,
        name: "Salary",
        type: "salary"
    },
    {
        style: "bg-cyan-500 text-white hover:bg-cyan-600",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: false,
        name: "Transfer",
        type: "transfer"
    },
    {
        style: "bg-pink-600 text-white hover:bg-pink-700",
        selected_style: "bg-gray-700 text-white hover:bg-gray-800",
        is_active: false,
        name: "Received",
        type: "received"
    },
]
const Transaction = () => {
    const [page, setPage] = React.useState(1)
    const [pageSize, setPageSize] = React.useState(10)
    const [types, setTypes] = React.useState(transactionType)
    const [type, setType] = React.useState('all')
    const [memberType] = React.useState(['all', 'received', 'transfer'])

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum)
        setPageSize(() => currentPageValue)
    }

    const {data: transactions, isLoading, refetch} = getTransactions({
        from_date: '',
        to_date: '',
        type,
        page: page,
        perPage: pageSize
    })

    const changeType = (n) => {
        setType(n.type)
        setTypes(() => transactionType.map( c => {
                if (n.type === c.type) {
                    c.is_active = true
                }else{
                    c.is_active = false
                }
                return c
        }))
    }

    const getTypeStyle = (type) => {
        let value = null;
        var i = 0;
        while(transactionType.length > 0){
            if (transactionType[i].type == type) {
                value = transactionType[i];
                break;
            }
            i++
        }
        return value
    }

    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                        <div className="sm:flex sm:items-center">
                                <div className="md:flex gap-3">
                                    {
                                        types.map( n => (
                                            <button key={Math.random()} onClick={() => changeType(n)}  className={"px-2 my-2 py-1 rounded-md mx-2 " + (n.is_active ? n.selected_style : n.style)}>{ n.name }</button>
                                        ))
                                    }
                                </div>

                            </div>
                        <div className="mt-8 flex flex-col">
                                        <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                                {isLoading ? (
                                    <LoaderAnimation />
                                ) : (
                                    <>
                                        {transactions?.data?.length ? (
                                    <>
                                    <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table className="min-w-full divide-y divide-gray-300">
                                            <thead className="bg-gray-50">
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                    >
                                                        Username
                                                    </th>
                                                    {
                                                        type == 'all' ?
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                        >
                                                            Type
                                                        </th>
                                                        : ''
                                                    }
                                                    {
                                                        memberType.includes(type)
                                                        ?
                                                        <th
                                                            scope="col"
                                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                        >
                                                            Member
                                                        </th>
                                                        : ''
                                                    }

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
                                                        Transaction At
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody className="divide-y divide-gray-200 bg-white">
                                                {transactions?.data?.map((transaction) => (
                                                    <tr key={Math.random()}>
                                                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                            {transaction?.user?.username}
                                                        </td>
                                                        {
                                                            type == 'all'
                                                            ?
                                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                <span className={"text-xs font-medium mr-2 px-2.5 py-0.5 rounded " + getTypeStyle(transaction?.type).style}>{getTypeStyle(transaction?.type).name}</span>
                                                            </td>
                                                            : ''
                                                        }
                                                        {
                                                            memberType.includes(type)
                                                            ?
                                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {transaction?.member?.username}
                                                            </td>
                                                            : ''
                                                        }

                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {transaction?.amount}
                                                        </td>

                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            {
                                                                transaction?.status
                                                                ? <span className="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Confirmed</span>
                                                                : <span className="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                                                            }
                                                        </td>
                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            <div>
                                                                {moment(
                                                                    transaction?.created_at
                                                                ).format(
                                                                    "MM-DD-YYYY, h:mm a"
                                                                )}
                                                            </div>
                                                            <div>
                                                                {moment(
                                                                    transaction?.created_at
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
                                            total={transactions?.total}
                                            pageSize={pageSize}
                                            pageNumber={page}
                                            handlePageChange={handlePageChange}
                                        />
                                    </div>
                                    </>
                                    ): (
                                        <RowNotFound name='transactions' />
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

export default Protected(Transaction);

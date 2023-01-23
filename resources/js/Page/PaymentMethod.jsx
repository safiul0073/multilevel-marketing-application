import React, { useEffect, useMemo, useState } from "react";
import LoaderAnimation from "../components/common/LoaderAnimation";
import Pagination from "../components/common/Pagination";
import RowNotFound from "../components/common/RowNotFound";
import Protected from "../components/HOC/Protected";
import CreateModal from "../components/modal/payemtnMethod/CreateModal";
import DeletePaymentMethod from "../components/modal/payemtnMethod/Delete";
import EditModal from "../components/modal/payemtnMethod/EditModal";
import { getPaymentMethodList } from "../hooks/queries/paymentMethod/getPaymentMethodList";

const PaymentMethod = () => {
    const [page, setPage] = useState(1)
    const [pageSize, setPageSize] = useState(10)

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum)
        setPageSize(() => currentPageValue)
    }
    // fetching category list using react query
    const {data, isLoading, refetch} = getPaymentMethodList(page, pageSize)

    // create category modal calling
    const [isOpen, setIsOpen] = useState(false)
    const createPaymentMethod = () => {
        setIsOpen(true)
    };

    const closeModal = () => {
        setIsOpen(false)
    }
    const [payment, setPaymentMethod] = useState()
    const [isEditModalOpen, setIsEditModalOpen] = useState(false)
    const editPaymentMethod = (payment) => {
        setPaymentMethod(payment)
        setIsEditModalOpen(true)
    };

    const closeEditModal = () => {
        setIsEditModalOpen(false)
    }
    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false)
    const [deletePayment, setDeletePayment] = useState()
    const delatePaymentMethod = (id) => {
        setDeletePayment(id)
        setIsDeleteModalOpen(true)
    };

    const closeDeleteModal = () => {
        setIsDeleteModalOpen(false)
    }

    return (
        <>
        <CreateModal
        isOpen={isOpen}
        setIsOpen={setIsOpen}
        closeModal={closeModal}
        refetch={refetch}
        />
        <EditModal
        isOpen={isEditModalOpen}
        setIsOpen={setIsEditModalOpen}
        closeModal={closeEditModal}
        refetch={refetch}
        payment={payment}
        />
        <DeletePaymentMethod
        isOpen={isDeleteModalOpen}
        setIsOpen={setIsDeleteModalOpen}
        closeModal={closeDeleteModal}
        refetch={refetch}
        payment={deletePayment}
        />
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="sm:flex sm:items-center">
                                <div className="sm:flex-auto">
                                    <h1 className="text-xl font-semibold text-gray-900">
                                        Payment Method List
                                    </h1>
                                </div>
                                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                    <button
                                        type="button"
                                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                        onClick={() => createPaymentMethod()}
                                    >
                                        Add New Payment Method
                                    </button>
                                </div>
                            </div>
                            <div className="mt-8 flex flex-col">
                                {isLoading ?
                                    <LoaderAnimation/>
                                    :
                                    <>
                                        {data?.data?.length
                                        ?
                                        <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
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
                                                                    Min
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Max
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Percentage
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Fixed
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Type
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right"
                                                                >
                                                                    Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody className="divide-y divide-gray-200 bg-white">
                                                            {data?.data?.map(
                                                                (payment) => (
                                                                    <tr
                                                                        key={Math.random()}
                                                                    >
                                                                        <td className="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-semibold text-sm text-gray-500 sm:pl-6">
                                                                            <div className="text-gray-900">
                                                                                {
                                                                                    payment?.name
                                                                                }
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {payment?.min}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {payment?.max}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {payment?.percent_charge}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {payment?.fixed_charge}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {payment?.type}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            {payment?.status ==
                                                                            1 ? (
                                                                                <span className="inline-flex rounded-full bg-green-100 px-2 text-xs leading-5 text-green-800">
                                                                                    Active
                                                                                </span>
                                                                            ) : (
                                                                                <span className="inline-flex rounded-full bg-red-100 px-2 text-xs leading-5 text-red-800">
                                                                                    Inactive
                                                                                </span>
                                                                            )}
                                                                        </td>
                                                                        <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                            <div className="flex gap-2 justify-end">
                                                                                <button
                                                                                    className="text-indigo-600 font-normal hover:text-indigo-700 hover:underline"
                                                                                    onClick={() =>
                                                                                        editPaymentMethod(
                                                                                            payment
                                                                                        )
                                                                                    }
                                                                                >
                                                                                    Edit
                                                                                </button>
                                                                                <button
                                                                                    className="text-red-600 font-normal hover:text-red-700 hover:underline"
                                                                                    onClick={() =>
                                                                                        delatePaymentMethod(
                                                                                            payment?.id
                                                                                        )
                                                                                    }
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
                                                <div className="my-4">
                                                    <Pagination
                                                        total={data?.total}
                                                        pageSize={pageSize}
                                                        pageNumber={page}
                                                        handlePageChange={handlePageChange}
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        : (<RowNotFound name="categories"/>)
                                        }
                                    </>
                                    }
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(PaymentMethod);

import moment from "moment";
import React, { useState } from "react";
import LoaderAnimation from "../components/common/LoaderAnimation";
import Pagination from "../components/common/Pagination";
import RowNotFound from "../components/common/RowNotFound";
import Protected from "../components/HOC/Protected";
import CreateModal from "../components/modal/epin/CreateModal";
import DeleteEpin from "../components/modal/epin/Delete";
import EditModal from "../components/modal/epin/EditModal";
import EpinList from "../components/modal/epin/EpinList";
import { getEpinList } from "../hooks/queries/epin/getEpinList";

const Epin = () => {
    const [page, setPage] = useState(1)
    const [pageSize, setPageSize] = useState(10)

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum)
        setPageSize(() => currentPageValue)
    }
    // fetching epin list using react query
    const {data:epinsList, isLoading, refetch} = getEpinList(page,pageSize)

    // create epin modal calling
    const [isOpen, setIsOpen] = useState(false)
    const createEpin = () => {
        setIsOpen(true)
    };

    const closeModal = () => {
        setIsOpen(false)
    }
    const [epin, setEpin] = useState()
    const [isEditModalOpen, setIsEditModalOpen] = useState(false)
    const editEpin = (epin) => {
        setEpin(epin)
        setIsEditModalOpen(true)
    };

    const closeEditModal = () => {
        setIsEditModalOpen(false)
    }
    const [isDeleteModalOpen, setIsDeleteModalOpne] = useState(false)
    const delateEpin = (id) => {
        setEpin(id)
        setIsDeleteModalOpne(true)
    };

    const closeDeleteModal = () => {
        setIsDeleteModalOpne(false)
    }

    const [isListModal, setListModal] = useState(false)
    const [epinMainId, setEpinMainId] = useState()
    // show epin list by modal
    const showEpinList = (id) => {
        setEpinMainId(id)
        setListModal(true)
    }

    return (
        <>
        <EpinList
        isOpen={isListModal}
        setIsOpen={setListModal}
        refetcher={refetch}
        epinMainId={epinMainId}
        />
        <CreateModal
        isOpen={isOpen}
        setIsOpen={setIsOpen}
        closeModal={closeModal}
        refetcher={refetch}
        />
        <EditModal
        isOpen={isEditModalOpen}
        setIsOpen={setIsEditModalOpen}
        closeModal={closeEditModal}
        refatcher={refetch}
        epin={epin}
        />
        <DeleteEpin
        isOpen={isDeleteModalOpen}
        setIsOpen={setIsDeleteModalOpne}
        closeModal={closeDeleteModal}
        refatcher={refetch}
        epin={epin}
        />
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="sm:flex sm:items-center">
                                <div className="sm:flex-auto">
                                    <h1 className="text-xl font-semibold text-gray-900">
                                        Epin List
                                    </h1>
                                </div>
                                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                    <button
                                        type="button"
                                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                        onClick={() => createEpin()}
                                    >
                                        Add New Epin
                                    </button>
                                </div>
                            </div>
                            <div className="mt-8 flex flex-col">
                                {isLoading ?
                                    <LoaderAnimation/>
                                    :
                                    <>
                                     {epinsList?.length
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
                                                                    Package
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Type/Name
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Cost
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Quantity
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Cus. Name
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Cus. Phone
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Code List
                                                                </th>
                                                                <th
                                                                    scope="col"
                                                                    className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                >
                                                                    Created At
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
                                                            {epinsList?.data?.map(
                                                                (epin) => (
                                                                    <tr
                                                                        key={Math.random()}
                                                                    >
                                                                        <td className="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-semibold text-sm text-gray-500 sm:pl-6">
                                                                            <div className="text-gray-900">
                                                                                {
                                                                                    epin?.product?.name
                                                                                }
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {epin?.type}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {epin?.cost}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {epin?.quantity}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {epin?.customer_name}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {epin?.customer_phone}
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                            <button onClick={() => showEpinList(epin?.id)} className="btn btn-secondary">Show Epin List</button>
                                                                            </div>
                                                                        </td>
                                                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                            <div className="text-gray-900">
                                                                                {moment(epin?.created_at).format("D-M-Y")}
                                                                            </div>
                                                                        </td>
                                                                        <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                            <div className="flex gap-2 justify-end">
                                                                                <button
                                                                                    className="text-indigo-600 font-normal hover:text-indigo-700 hover:underline"
                                                                                    onClick={() =>
                                                                                        editEpin(
                                                                                            epin
                                                                                        )
                                                                                    }
                                                                                >
                                                                                    Edit
                                                                                </button>
                                                                                <button
                                                                                    className="text-red-600 font-normal hover:text-red-700 hover:underline"
                                                                                    onClick={() =>
                                                                                        delateEpin(
                                                                                            epin?.id
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
                                                        total={epinsList?.total}
                                                        pageSize={pageSize}
                                                        pageNumber={page}
                                                        handlePageChange={handlePageChange}
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        : (<RowNotFound name="epins" />)

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

export default Protected(Epin);

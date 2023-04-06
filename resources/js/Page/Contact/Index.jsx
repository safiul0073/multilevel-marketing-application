import React, { memo, useState } from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Protected from "../../components/HOC/Protected";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import { useDocumentTitle } from "../../hooks/others";
import { Link } from "react-router-dom";
import { limitString } from "../../helper/functions";
import { getContactList } from "../../hooks/queries/contact/getContactList";
import DeleteContact from "../../components/modal/Contact/Delete"

const Index = () => {
    useDocumentTitle("Contact");
    const [page, setPage] = useState(1);
    const [pageSize, setPageSize] = useState(10);

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum);
        setPageSize(() => currentPageValue);
    };
    // fetching category list using react query
    const { data, isLoading, refetch } = getContactList(page, pageSize, 2);

    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
    const [contact, setContact] = useState();

    const delateContact = (id) => {
        setContact(id);
        setIsDeleteModalOpen(true);
    };

    const closeDeleteModal = () => {
        setIsDeleteModalOpen(false);
    };

    return (
        <>
            <DeleteContact
                isOpen={isDeleteModalOpen}
                setIsOpen={setIsDeleteModalOpen}
                closeModal={closeDeleteModal}
                refetch={refetch}
                contact={contact}
            />
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="sm:flex sm:items-center">
                                <div className="sm:flex-auto">
                                    <h1 className="text-xl font-semibold text-gray-900">
                                        Contact List
                                    </h1>
                                </div>
                            </div>
                            <div className="mt-8 flex flex-col">
                                {isLoading ? (
                                    <LoaderAnimation />
                                ) : (
                                    <>
                                        {data?.data?.length ? (
                                            <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                                                    <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                                        <table className="min-w-full divide-y divide-gray-300">
                                                            <thead className="bg-gray-50">
                                                                <tr>
                                                                    <th
                                                                        scope="col"
                                                                        className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                                    >
                                                                        Sr.
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
                                                                        Subject
                                                                    </th>
                                                                    <th
                                                                        scope="col"
                                                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                    >
                                                                        Message
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
                                                                    (
                                                                        contact
                                                                    ) => (
                                                                        <tr
                                                                            key={Math.random()}
                                                                        >
                                                                            <td className="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-semibold text-sm text-gray-500 sm:pl-6">
                                                                                <div className="text-gray-900">
                                                                                    {
                                                                                        contact?.id
                                                                                    }
                                                                                </div>
                                                                            </td>
                                                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                <div className="text-gray-900">
                                                                                    {
                                                                                        contact?.email
                                                                                    }
                                                                                </div>
                                                                            </td>
                                                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                <div className="text-gray-900">
                                                                                    {
                                                                                        contact?.subject
                                                                                    }
                                                                                </div>
                                                                            </td>
                                                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                <div className="text-gray-900">
                                                                                    {limitString(
                                                                                        contact?.message,
                                                                                        50
                                                                                    )}
                                                                                </div>
                                                                            </td>
                                                                            <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                                <div className="flex gap-2 justify-end">
                                                                                    {/* <Link
                                                                                        className="text-indigo-600 font-normal hover:text-indigo-700 hover:underline"
                                                                                    to={`/staff/gallery/${contact?.id}`}
                                                                                    >
                                                                                        Details
                                                                                    </Link> */}
                                                                                    <button
                                                                                        className="text-red-600 font-normal hover:text-red-700 hover:underline"
                                                                                        onClick={() =>
                                                                                            delateContact(
                                                                                                contact?.id
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
                                                            handlePageChange={
                                                                handlePageChange
                                                            }
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        ) : (
                                            <RowNotFound name="contacts" />
                                        )}
                                    </>
                                )}
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};
export default Protected(memo(Index));

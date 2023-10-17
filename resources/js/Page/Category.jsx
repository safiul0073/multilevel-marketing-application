import React, { useEffect, useMemo, useState } from "react";
import LoaderAnimation from "../components/common/LoaderAnimation";
import Pagination from "../components/common/Pagination";
import RowNotFound from "../components/common/RowNotFound";
import Protected from "../components/HOC/Protected";
import Card from "../components/ui/Card";
import CreateModal from "../components/modal/category/CreateModal";
import DeleteCategory from "../components/modal/category/Delete";
import EditModal from "../components/modal/category/EditModal";
import { getCategoryList } from "../hooks/queries/category/getCategoryList";
import PageHeader from "../components/ui/PageHeader";
import TableBlock from "../components/ui/TableBlock";

const labels = [
    { key: "id", label: "Id" },
    { key: "title", label: "Title" },
    { key: "status", label: "Status" },
    { key: "action", label: "Action" },
];

const Category = () => {
    const [page, setPage] = useState(1);
    const [pageSize, setPageSize] = useState(10);

    // fetching category list using react query
    const { data, isLoading, refetch } = getCategoryList(page, pageSize);


    // create category modal calling
    const [isOpen, setIsOpen] = useState(false);
    const createCategory = () => {
        setIsOpen(true);
    };

    const closeModal = () => {
        setIsOpen(false);
    };
    const [category, setCategory] = useState();
    const [isEditModalOpen, setIsEditModalOpen] = useState(false);
    const editCategory = (category) => {
        setCategory(category);
        setIsEditModalOpen(true);
    };

    const closeEditModal = () => {
        setIsEditModalOpen(false);
    };
    const [isDeleteModalOpen, setIsDeleteModalOpne] = useState(false);
    const delateCategory = (id) => {
        setCategory(id);
        setIsDeleteModalOpne(true);
    };

    const closeDeleteModal = () => {
        setIsDeleteModalOpne(false);
    };

    return (
        <>
            <CreateModal
                isOpen={isOpen}
                setIsOpen={setIsOpen}
                closeModal={closeModal}
                refatcher={refetch}
            />
            <EditModal
                isOpen={isEditModalOpen}
                setIsOpen={setIsEditModalOpen}
                closeModal={closeEditModal}
                refatcher={refetch}
                category={category}
            />
            <DeleteCategory
                isOpen={isDeleteModalOpen}
                setIsOpen={setIsDeleteModalOpne}
                closeModal={closeDeleteModal}
                refatcher={refetch}
                category={category}
            />
            <Card
                headerSlot={
                    <PageHeader
                        title="Category List"
                        buttonName="Add Category"
                        onClick={createCategory}
                    />
                }
            >
                <TableBlock
                    pageName="categories"
                    isLoading={isLoading}
                    totalDataCount={data?.total}
                    page={page}
                    setPage={setPage}
                    pageSize={pageSize}
                    setPageSize={setPageSize}
                    dataLength={data?.data?.length}
                    labels={labels}
                >
                    <>
                        {data?.data?.map((category) => (
                            <tr key={Math.random()}>
                                <td className="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-semibold text-sm text-gray-500 sm:pl-6">
                                    <div className="text-gray-900">
                                        {category?.id}
                                    </div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {category?.name || category?.title}
                                    </div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {category?.status == 1 ? (
                                        <span className="inline-flex rounded-full bg-green-100 px-2 text-xs leading-5 text-green-800">
                                            Active
                                        </span>
                                    ) : (
                                        <span className="inline-flex rounded-full bg-red-100 px-2 text-xs leading-5 text-red-800">
                                            Inactive
                                        </span>
                                    )}
                                </td>
                                <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                    <div className="flex gap-2 justify-start">
                                        <button
                                            className="text-indigo-600 font-normal hover:text-indigo-700 hover:underline"
                                            onClick={() =>
                                                editCategory(category)
                                            }
                                        >
                                            Edit
                                        </button>
                                        <button
                                            className="text-red-600 font-normal hover:text-red-700 hover:underline"
                                            onClick={() =>
                                                delateCategory(category?.id)
                                            }
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        ))}
                    </>
                </TableBlock>
            </Card>
        </>
    );
};

export default Protected(Category);

import React, { useEffect, useMemo, useState } from "react";
import Protected from "../components/HOC/Protected";
import Card from "../components/ui/Card";
import CreateModal from "../components/modal/social-link/CreateModal";
import DeleteCategory from "../components/modal/social-link/Delete";
import EditModal from "../components/modal/social-link/EditModal";
import { getCategoryList } from "../hooks/queries/category/getCategoryList";
import PageHeader from "../components/ui/PageHeader";
import TableBlock from "../components/ui/TableBlock";
import { getSocialLinkList } from "../hooks/queries/social-link/getSocialLinkList";
import { getSocialIcons } from "../hooks/queries/social-link/getSocialIcons";

const labels = [
    { key: "id", label: "Id" },
    { key: "title", label: "Title" },
    { key: "status", label: "Icon" },
    { key: "link", label: "Lunk" },
    { key: "action", label: "Action" },
];

const Category = () => {
    const [page, setPage] = useState(1);
    const [pageSize, setPageSize] = useState(10);

    // fetching social-link list using react query
    const { data, isLoading, refetch } = getSocialLinkList(page, pageSize);
    const { data: icons } = getSocialIcons();

    // create social-link modal calling
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
                icons={icons}
            />
            <EditModal
                isOpen={isEditModalOpen}
                setIsOpen={setIsEditModalOpen}
                closeModal={closeEditModal}
                refatcher={refetch}
                category={category}
                icons={icons}
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
                        title="Social Link List"
                        buttonName="Add Social link"
                        onClick={createCategory}
                    />
                }
            >
                <TableBlock
                    pageName="social-links"
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
                                        {category?.title}
                                    </div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div
                                        className="text-gray-900"
                                        dangerouslySetInnerHTML={{
                                            __html: category?.icon,
                                        }}
                                    ></div>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div className="text-gray-900">
                                        {category?.link}
                                    </div>
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

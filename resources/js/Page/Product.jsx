import React, { useEffect, useMemo, useState } from "react";
import LoaderAnimation from "../components/common/LoaderAnimation";
import Protected from "../components/HOC/Protected";
import CreateModal from "../components/modal/product/CreateModal";
import DeleteProduct from "../components/modal/product/Delete";
import EditModal from "../components/modal/product/EditModal";
import ProductView from "../components/Product";
import { getProductList } from "../hooks/queries/product/getProductList";

export const Product = () => {
    // fetching product list using react query
    const { data, isLoading, refetch } = getProductList();
    // memorising getting data
    const productList = useMemo(() => data?.data, [data]);

    // create product modal calling
    const [isOpen, setIsOpen] = useState(false);
    const createProduct = () => {
        setIsOpen(true);
    };

    const closeModal = () => {
        setIsOpen(false);
    };
    const [product, setProduct] = useState();
    const [viewProduct, setViewProduct] = useState(null);
    const [isEditModalOpen, setIsEditModalOpen] = useState(false);
    const editProduct = (product) => {
        setProduct(product);
        setIsEditModalOpen(true);
    };

    const closeEditModal = () => {
        setIsEditModalOpen(false);
    };
    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
    const delateProduct = (id) => {
        setProduct(id);
        setIsDeleteModalOpen(true);
    };

    const closeDeleteModal = () => {
        setIsDeleteModalOpen(false);
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
                product={product}
            />
            <DeleteProduct
                isOpen={isDeleteModalOpen}
                setIsOpen={setIsDeleteModalOpen}
                closeModal={closeDeleteModal}
                refatcher={refetch}
                product={product}
            />
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            {viewProduct ? (
                                <ProductView
                                    viewProduct={viewProduct}
                                    setViewProduct={setViewProduct}
                                />
                            ) : (
                                <>
                                    <div className="sm:flex sm:items-center">
                                        <div className="sm:flex-auto">
                                            <h1 className="text-xl font-semibold text-gray-900">
                                                Package List
                                            </h1>
                                        </div>
                                        <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                            <button
                                                type="button"
                                                className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                                onClick={() => createProduct()}
                                            >
                                                Add New Package
                                            </button>
                                        </div>
                                    </div>
                                    <div className="mt-8 flex flex-col">
                                        {isLoading ? (
                                            <LoaderAnimation />
                                        ) : (
                                            <>
                                                {productList?.length ? (
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
                                                                                Sr.
                                                                            </th>
                                                                            <th
                                                                                scope="col"
                                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                            >
                                                                                Name
                                                                            </th>
                                                                            <th
                                                                                scope="col"
                                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                            >
                                                                                Category
                                                                            </th>
                                                                            <th
                                                                                scope="col"
                                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                            >
                                                                                Referrel
                                                                                Commission
                                                                            </th>
                                                                            <th
                                                                                scope="col"
                                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                            >
                                                                                Price
                                                                            </th>
                                                                            <th
                                                                                scope="col"
                                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                                            >
                                                                                Status
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
                                                                        {[
                                                                            ...productList,
                                                                        ]?.map(
                                                                            (
                                                                                product
                                                                            ) => (
                                                                                <tr
                                                                                    key={Math.random()}
                                                                                >
                                                                                    <td className="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-semibold text-sm text-gray-500 sm:pl-6">
                                                                                        <div className="text-gray-900">
                                                                                            {
                                                                                                product?.id
                                                                                            }
                                                                                        </div>
                                                                                    </td>
                                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                        <div className="text-gray-900">
                                                                                            {product?.name ||
                                                                                                product?.title}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                        <div className="text-gray-900">
                                                                                            {product
                                                                                                ?.category
                                                                                                ?.name ||
                                                                                                product
                                                                                                    ?.category
                                                                                                    ?.title}
                                                                                        </div>
                                                                                    </td>

                                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                        <div className="text-gray-900">
                                                                                            {
                                                                                                product?.refferral_commission
                                                                                            }
                                                                                        </div>
                                                                                    </td>
                                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                        <div className="text-gray-900">
                                                                                            {
                                                                                                product?.price
                                                                                            }
                                                                                        </div>
                                                                                    </td>
                                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                        {product?.status ==
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
                                                                                                className="text-sky-600 font-normal hover:text-sky-700 hover:underline"
                                                                                                onClick={() =>
                                                                                                    setViewProduct(
                                                                                                        product
                                                                                                    )
                                                                                                }
                                                                                            >
                                                                                                Details
                                                                                            </button>
                                                                                            <button
                                                                                                className="text-indigo-600 font-normal hover:text-indigo-700 hover:underline"
                                                                                                onClick={() =>
                                                                                                    editProduct(
                                                                                                        product
                                                                                                    )
                                                                                                }
                                                                                            >
                                                                                                Edit
                                                                                            </button>
                                                                                            <button
                                                                                                className="text-red-600 font-normal hover:text-red-700 hover:underline"
                                                                                                onClick={() =>
                                                                                                    delateProduct(
                                                                                                        product?.id
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
                                                        </div>
                                                    </div>
                                                ) : (
                                                    <div className="text-center border border-gray-200 px-5 py-10 rounded-2xl">
                                                        <svg
                                                            className="mx-auto h-12 w-12 text-gray-400"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            strokeWidth={1.5}
                                                            stroke="currentColor"
                                                        >
                                                            <path
                                                                strokeLinecap="round"
                                                                strokeLinejoin="round"
                                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"
                                                            />
                                                        </svg>

                                                        <h3 className="mt-2 text-sm font-medium text-gray-900">
                                                            No projects
                                                        </h3>
                                                        <p className="mt-1 text-sm text-gray-500">
                                                            Get started by
                                                            creating a new
                                                            project.
                                                        </p>
                                                    </div>
                                                )}
                                            </>
                                        )}
                                    </div>
                                </>
                            )}
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};
export default Protected(Product);

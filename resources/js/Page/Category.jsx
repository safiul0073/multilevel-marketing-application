import React from "react";

export const Category = () => {
    const categoryList = [
        {
            id: "01",
            name: "Front-end Developer",
            status: "active",
            description: "Category Description",
        },
        {
            id: "02",
            name: "Front-end Developer",
            status: "inactive",
            description: "Category Description",
        },
        {
            id: "03",
            name: "Front-end Developer",
            status: "active",
            description: "Category Description",
        },
        {
            id: "04",
            name: "Front-end Developer",
            status: "inactive",
            description: "Category Description",
        },
        {
            id: "05",
            name: "Front-end Developer",
            status: "inactive",
            description: "Category Description",
        },
        {
            id: "06",
            name: "Front-end Developer",
            status: "active",
            description: "Category Description",
        },
        {
            id: "07",
            name: "Front-end Developer",
            status: "active",
            description: "Category Description",
        },
        {
            id: "08",
            name: "Front-end Developer",
            status: "active",
            description: "Category Description",
        },
        {
            id: "09",
            name: "Front-end Developer",
            status: "active",
            description: "Category Description",
        },
        {
            id: "10",
            name: "Front-end Developer",
            status: "inactive",
            description: "Category Description",
        },
    ];

    const createCategory = () => {
        console.log("Create Category");
    };

    const editCategory = (id) => {
        console.log(`Edit Category ${id}`);
    };

    const delateCategory = (id) => {
        console.log(`Delete Category ${id}`);
    };
    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="sm:flex sm:items-center">
                                <div className="sm:flex-auto">
                                    <h1 className="text-xl font-semibold text-gray-900">
                                        Category List
                                    </h1>
                                </div>
                                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                    <button
                                        type="button"
                                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                        onClick={() => createCategory()}
                                    >
                                        Add New Category
                                    </button>
                                </div>
                            </div>
                            <div className="mt-8 flex flex-col">
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
                                                            Title
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
                                                    {categoryList?.map(
                                                        (category) => (
                                                            <tr
                                                                key={Math.random()}
                                                            >
                                                                <td className="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-semibold text-sm text-gray-500 sm:pl-6">
                                                                    <div className="text-gray-900">
                                                                        {
                                                                            category?.id
                                                                        }
                                                                    </div>
                                                                </td>
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    <div className="text-gray-900">
                                                                        {category?.name ||
                                                                            category?.title}
                                                                    </div>
                                                                </td>
                                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                    {category?.status ==
                                                                    "active" ? (
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
                                                                                editCategory(
                                                                                    category?.id
                                                                                )
                                                                            }
                                                                        >
                                                                            Edit
                                                                        </button>
                                                                        <button
                                                                            className="text-red-600 font-normal hover:text-red-700 hover:underline"
                                                                            onClick={() =>
                                                                                delateCategory(
                                                                                    category?.id
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
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

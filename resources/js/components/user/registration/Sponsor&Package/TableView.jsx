import React from 'react'

const TableView = ({ lists }) => {
  return (
    <>

        <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table className="min-w-full divide-y divide-gray-300">
                    <thead className="bg-gray-50">
                        <tr>

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
                                Referral
                                Commission
                            </th>
                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-200 bg-white">
                        {[
                            ...lists,
                        ]?.map(
                            (
                                product
                            ) => (
                                <tr
                                    key={Math.random()}
                                >

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

                                </tr>
                            )
                        )}
                    </tbody>
                </table>
            </div>
        </div>
    </>
  )
}

export default TableView

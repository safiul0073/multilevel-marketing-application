import React from 'react'
import { UseStore } from '../../../store'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';
import { useState } from 'react';

const OrderSummary = ({ setTab }) => {
    const {userRegister, product} = UseStore()
    const [epin, setEpin] = useState()
    const handleEpinValue = (e) => {
        setEpin(e.target.value)
        userRegister.epin_code = e.target.value
    }

    const handleSubmit = () => {
        console.log(userRegister)
    }
  return (
    <>
    <div>
        <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table className="min-w-full divide-y divide-gray-300">
                    <thead className="bg-gray-50">
                        <tr>

                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                SI No
                            </th>
                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Item
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
                                Net Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-200 bg-white">

                                <tr
                                >

                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            {1}
                                        </div>
                                    </td>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            {product?.name}
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
                                        <div className="text-gray-900">
                                            {
                                                product?.price
                                            }
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">

                                        </div>
                                    </td>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            {product?.name}
                                        </div>
                                    </td>

                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            <span>Sub Total :</span>
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
                                <tr>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">

                                        </div>
                                    </td>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            {product?.name}
                                        </div>
                                    </td>

                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            <span className='text-red-500'>Registration Fee :</span>
                                        </div>
                                    </td>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            {
                                                0.00
                                            }
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">

                                        </div>
                                    </td>
                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            {product?.name}
                                        </div>
                                    </td>

                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div className="text-gray-900">
                                            <span>Total :</span>
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
                    </tbody>
                </table>
            </div>
        </div>

        <Tabs className="container my-3  md:flex gap-8">
            <TabList className="w-44 bg-gray-300  flex md:flex-col">
            <Tab>E-Pin</Tab>
            <Tab>Title 2</Tab>
            </TabList>

            <TabPanel>
                <div className='w-42 mx-auto formGroup'>
                    <input type="text" value={epin} onChange={handleEpinValue} className='form-control border border-gray-700' />
                    <button onClick={handleSubmit} className='btn btn-primary'>Submit</button>
                </div>
            </TabPanel>
            <TabPanel>
            <h2>Any content 2</h2>
            </TabPanel>
        </Tabs>
        </div>
    </>
  )
}

export default OrderSummary

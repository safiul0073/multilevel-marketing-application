import { Dialog, Transition } from '@headlessui/react'
import { yupResolver } from '@hookform/resolvers/yup';
import { Fragment, useState } from 'react'
import { useForm } from 'react-hook-form';
import { AiFillCloseCircle, AiFillPlusCircle } from "react-icons/ai";
import { useMutation } from 'react-query';
import * as yup from "yup";
import  toast  from 'react-hot-toast';
import Textinput from '../../common/Textinput';
import { createEpin, deleteOnlyEpin } from '../../../hooks/queries/epin';
import { getEpinMain } from '../../../hooks/queries/epin/getEpinMain';
import moment from 'moment';
export default function EpinList({isOpen, setIsOpen, closeModal, refetcher, epinMainId}) {

    const {data:epinMain, refetch:epinRefetch} = getEpinMain({epinMainId})

    const createNewEpin= () => {
        createEpinMutate({
            epin_main_id: epinMainId,
            code: generateCode(),
            quantity: 1
        })
    }
    function closeModal() {
        setIsOpen(false)
    }
    const {
        mutate: createEpinMutate,
        isLoading,
    } = useMutation(createEpin, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            refetcher()
            epinRefetch()
        },
        onError: (err) => {

        let errorobj = err?.response?.data?.data?.json_object;
        setBackendError({
            ...backendError,
            ...errorobj,
        });
        },
    });
    const {
        mutate: deleteEpinMutate,
        isLoading: deleteLoading,
    } = useMutation(deleteOnlyEpin, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            refetcher()
            epinRefetch()
        },
        onError: (err) => {

        let errorobj = err?.response?.data?.data?.json_object;
        setBackendError({
            ...backendError,
            ...errorobj,
        });
        },
    });
    //   delete epin
    const delateEpin = (id) => {
        deleteEpinMutate(id)
    };
  const generateCode = () => {
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
        var string_length = 14;
        var randomString = '';
        for (var i=0; i<string_length; i++) {
         var rnum = Math.floor(Math.random() * chars.length);
         randomString += chars.substring(rnum,rnum+1);
        }
    return randomString;
  }
  return (
    <>

      <Transition appear show={isOpen} as={Fragment}>
        <Dialog as="div" className="relative z-10" onClose={closeModal}>
          <Transition.Child
            as={Fragment}
            enter="ease-out duration-300"
            enterFrom="opacity-0"
            enterTo="opacity-100"
            leave="ease-in duration-200"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
          >
            <div className="fixed inset-0 bg-black bg-opacity-25" />
          </Transition.Child>

          <div className="fixed inset-0 overflow-y-auto">
            <div className="flex min-h-full items-center justify-center p-4 text-center">
              <Transition.Child
                as={Fragment}
                enter="ease-out duration-300"
                enterFrom="opacity-0 scale-95"
                enterTo="opacity-100 scale-100"
                leave="ease-in duration-200"
                leaveFrom="opacity-100 scale-100"
                leaveTo="opacity-0 scale-95"
              >
                <div className="inline-block w-full max-w-2xl pb-4 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-[3px]">
                    <div className="flex items-center bg-indigo-700 text-white py-4 px-4 mb-6 font-medium text-lg text-left rounded-t-[3px]">
                        Epin List
                    </div>
                    <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table className="min-w-full divide-y divide-gray-300">
                                <thead className="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                        >
                                            Code
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Gen. At
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
                                            Used By
                                        </th>

                                        <th
                                            scope="col"
                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Activated At
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-200 bg-white">
                                    {epinMain?.epins?.map(
                                        (epin) => (
                                            <tr
                                                key={Math.random()}
                                                >
                                                <td className="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-semibold text-sm text-gray-500 sm:pl-6">
                                                    <div className="text-gray-900">
                                                        {
                                                            epin?.code
                                                        }
                                                    </div>
                                                </td>

                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div className="text-gray-900">
                                                        <div>
                                                        {moment(epin?.created_at).format("d-m-Y")}
                                                        </div>
                                                        <div>
                                                        {moment(epin?.created_at).fromNow()}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {epin?.status ==
                                                    1 ? (
                                                        <span className="inline-flex rounded-full bg-green-100 px-2 text-xs leading-5 text-green-800">
                                                            used
                                                        </span>
                                                    ) : (
                                                        <span className="inline-flex rounded-full bg-red-100 px-2 text-xs leading-5 text-red-800">
                                                            unused
                                                        </span>
                                                    )}
                                                </td>
                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div className="text-gray-900">
                                                        {epin?.use_by}
                                                    </div>
                                                </td>
                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div className="text-gray-900">
                                                    <div>
                                                        {epin?.activation_date ? moment(epin?.activation_date).format("d-m-Y") : ''}
                                                        </div>
                                                        <div>
                                                        {epin?.activation_date ? moment(epin?.activation_date).fromNow() : ''}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div className="text-gray-900">
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
                    </div>
                        <div className='px-6'>
                            <div className=" w-3/4 mx-auto">
                                <div className='flex justify-end mt-4'>
                                    <div className='mr-3'>
                                    {isLoading ? (
                                        <>
                                        <button className="btn btn-primary flex justify-center align-center" type="button" disabled>
                                            <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Processing ...
                                        </button>
                                        </>
                                    ) : (
                                        <button onClick={createNewEpin} className=' cursor-pointer bg-indigo-700 text-white font-normal px-4 py-1 rounded-md' >Add new Epin</button>
                                    )}
                                    </div>
                                    <div onClick={closeModal} className="bg-red-500 text-white font-normal px-4 py-1 rounded-md cursor-pointer">
                                        <span className="inline-flex  items-center">
                                            <span className='inline-flex mr-2'><AiFillCloseCircle /></span>
                                            <span>Close</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
              </Transition.Child>
            </div>
          </div>
        </Dialog>
      </Transition>
    </>
  )
}
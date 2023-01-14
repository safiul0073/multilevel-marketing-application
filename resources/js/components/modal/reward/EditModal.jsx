import { Dialog, Transition } from '@headlessui/react'
import { yupResolver } from '@hookform/resolvers/yup';
import { Fragment, useEffect, useState } from 'react'
import { useForm } from 'react-hook-form';
import { AiFillCloseCircle, AiFillPlusCircle } from "react-icons/ai";
import { useMutation } from 'react-query';
import  toast  from 'react-hot-toast';
import * as yup from "yup";
import { updateReward } from '../../../hooks/queries/reward';
import Textinput from '../../common/Textinput';

export default function EditModal({isOpen, setIsOpen, closeModal, refatcher, reward}) {

    const [backendError, setBackendError] = useState()

    const schema = yup
        .object({
            title: yup.string().min(4, "Too Short!")
            .max(50, "Too Long!"),

        })
        .required();

    const { register,reset, handleSubmit, formState: { errors } } = useForm({
        resolver: yupResolver(schema)
    })

    const onSubmit= (data) => {
        updateRewardMutate(data)
    }

    function closeModal() {
        setIsOpen(false)
    }

    useEffect(() => {
        if (reward) {
            reset(reward)
        }
    }, [reward])

    const {
        mutate: updateRewardMutate,
        isLoading,
    } = useMutation(updateReward, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            refatcher()
            closeModal()

        },
        onError: (err) => {

            let errorobj = err?.response?.data?.data?.json_object;
            setBackendError({
            ...backendError,
            ...errorobj,
            });
        },
    });
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
                        <span className="inline-block text-2xl mr-3"><AiFillPlusCircle /></span>
                        Update Reward
                    </div>
                        <div className='px-6'>
                            <form onSubmit={handleSubmit(onSubmit)}>
                                <div className=" w-3/4 mx-auto">
                                <Textinput
                                        label="Rank Designation"
                                        placeholder="l1"
                                        register={register}
                                        name="designation"
                                        type="text"
                                        backendValidationError={backendError?.designation}
                                        error={errors.designation}
                                    />
                                    <Textinput
                                        label="Right Count"
                                        placeholder="30"
                                        register={register}
                                        name="right_count"
                                        type="text"
                                        backendValidationError={backendError?.right_count}
                                        error={errors.right_count}
                                    />
                                     <Textinput
                                        label="Left Count"
                                        placeholder="30"
                                        register={register}
                                        name="left_count"
                                        type="text"
                                        backendValidationError={backendError?.left_count}
                                        error={errors.left_count}
                                    />
                                <div className="col-span-12">
                                    <label
                                        htmlFor="message"
                                        className="block text-sm font-medium text-gray-700"
                                    >
                                        Travel Reward
                                    </label>
                                    <textarea
                                        type="number"
                                        name="message"
                                        id="message"
                                        rows="5"
                                        {...register('travel_destination')}
                                        autoComplete="Travel Reward"
                                        className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    ></textarea>
                                    <span className="error-message">{backendError?.travel_destination}</span>
                                </div>

                                <div className="col-span-12">
                                    <label
                                        htmlFor="message"
                                        className="block text-sm font-medium text-gray-700"
                                    >
                                        One Time Bonus
                                    </label>
                                    <textarea
                                        type="number"
                                        name="message"
                                        id="message"
                                        rows="5"
                                        {...register('one_time_bonus')}
                                        autoComplete="Travel Reward"
                                        className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    ></textarea>
                                    <span className="error-message">{backendError?.one_time_bonus}</span>
                                </div>

                                <div className="col-span-12">
                                    <label
                                        htmlFor="message"
                                        className="block text-sm font-medium text-gray-700"
                                    >
                                        Salary
                                    </label>
                                    <textarea
                                        type="number"
                                        name="message"
                                        id="message"
                                        rows="5"
                                        {...register('salary')}
                                        autoComplete="Travel Reward"
                                        className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    ></textarea>
                                    <span className="error-message">{backendError?.salary}</span>
                                </div>

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
                                            <input type="submit" value="Update" className=' cursor-pointer bg-indigo-700 text-white font-normal px-4 py-1 rounded-md' />
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
                            </form>

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

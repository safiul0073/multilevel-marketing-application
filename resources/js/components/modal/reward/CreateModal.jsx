import { Dialog, Transition } from '@headlessui/react'
import { yupResolver } from '@hookform/resolvers/yup';
import { Fragment, useState } from 'react'
import { useForm } from 'react-hook-form';
import { AiFillCloseCircle, AiFillPlusCircle } from "react-icons/ai";
import { useMutation } from 'react-query';
import * as yup from "yup";
import { createReward } from '../../../hooks/queries/reward';
import  toast  from 'react-hot-toast';
import Textinput from '../../common/Textinput';
export default function CreateModal({isOpen, setIsOpen, closeModal, refatcher}) {

    const [backendError, setBackendError] = useState()

    const { register, handleSubmit, formState: { errors } } = useForm()
    const onSubmit= (data) => {
        createRewardMutate(data)
    }
  function closeModal() {
    setIsOpen(false)
  }
  const {
    mutate: createRewardMutate,
    isLoading,
  } = useMutation(createReward, {
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
                        Create Reward
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
                                    <Textinput
                                        label="Travel Reward"
                                        placeholder="India"
                                        register={register}
                                        name="travel_destination"
                                        type="text"
                                        backendValidationError={backendError?.travel_destination}
                                        error={errors.travel_destination}
                                    />
                                    <Textinput
                                        label="One Time Bonus"
                                        placeholder="30k cash"
                                        register={register}
                                        name="one_time_bonus"
                                        type="text"
                                        backendValidationError={backendError?.one_time_bonus}
                                        error={errors.one_time_bonus}
                                    />
                                    <Textinput
                                        label="Salary"
                                        placeholder="10,000"
                                        register={register}
                                        name="salary"
                                        type="text"
                                        backendValidationError={backendError?.salary}
                                        error={errors.salary}
                                    />
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
                                            <input type="submit" value="Create" className=' cursor-pointer bg-indigo-700 text-white font-normal px-4 py-1 rounded-md' />
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

import { Dialog, Transition } from '@headlessui/react'
import { yupResolver } from '@hookform/resolvers/yup';
import { Fragment, useState } from 'react'
import { useForm } from 'react-hook-form';
import { AiFillCloseCircle, AiFillPlusCircle } from "react-icons/ai";
import { useMutation } from 'react-query';
import * as yup from "yup";
import { createCategory } from '../../../hooks/queries/category';
import  toast  from 'react-hot-toast';
import Textinput from '../../common/Textinput';
import { createPaymentMethod } from '../../../hooks/queries/paymentMethod';
export default function CreateModal({isOpen, setIsOpen, closeModal, refetch}) {

    const [backendError, setBackendError] = useState()
    const { register, handleSubmit, formState: { errors } } = useForm()
    const onSubmit= (data) => {
        createPaymentMutate({
            ...data,
            type: 'manual'
        })
    }
  function closeModal() {
    setIsOpen(false)
  }
  const {
    mutate: createPaymentMutate,
    isLoading,
  } = useMutation(createPaymentMethod, {
    onSuccess: (data) => {
        toast.success(data, {
            position: 'top-right'
        });
        refetch()
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
                        Create Payment Method
                    </div>

                        <div className='px-6'>
                            <form onSubmit={handleSubmit(onSubmit)}>
                                <div className=" w-3/4 mx-auto">
                                    <Textinput
                                        label="Name"
                                        placeholder="Bkash"
                                        register={register}
                                        name="name"
                                        type="text"
                                        backendValidationError={backendError?.name}
                                        error={errors.name}
                                    />
                                    <Textinput
                                        label="Minimum Amount"
                                        placeholder="50"
                                        register={register}
                                        name="min"
                                        type="number"
                                        backendValidationError={backendError?.min}
                                        error={errors.min}
                                    />
                                    <Textinput
                                        label="Maximum Amount"
                                        placeholder="10000"
                                        register={register}
                                        name="max"
                                        type="text"
                                        backendValidationError={backendError?.max}
                                        error={errors.max}
                                    />
                                    <Textinput
                                        label="Percentage Charge(%)"
                                        placeholder="5"
                                        register={register}
                                        name="percent_charge"
                                        type="text"
                                        backendValidationError={backendError?.percent_charge}
                                        error={errors.percent_charge}
                                    />
                                    <Textinput
                                        label="Fixed Charge"
                                        placeholder="10"
                                        register={register}
                                        name="fixed_charge"
                                        type="text"
                                        backendValidationError={backendError?.fixed_charge}
                                        error={errors.fixed_charge}
                                    />
                                    <div className='formGroup'>
                                        <label className="label-style" htmlFor="status">Status</label>
                                        <select {...register('status', { required: true })} className='form-control' name="status" id="status">
                                            <option value="">Select a status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
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

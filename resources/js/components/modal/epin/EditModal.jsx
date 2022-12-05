import { Dialog, Transition } from '@headlessui/react'
import { yupResolver } from '@hookform/resolvers/yup';
import { Fragment, useEffect, useState } from 'react'
import { useForm } from 'react-hook-form';
import { AiFillCloseCircle, AiFillPlusCircle } from "react-icons/ai";
import { useMutation } from 'react-query';
import  toast  from 'react-hot-toast';
import * as yup from "yup";
import Textinput from '../../common/Textinput';
import { updateEpin } from '../../../hooks/queries/epin';

export default function EditModal({isOpen, setIsOpen, closeModal, refatcher, epin}) {

    const [code ,setCode] = useState('')
    const [backendError, setBackendError] = useState()
    const handleCode = (e) => {
        setCode(e.target.value)
      }
      const generateCode = () => {
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
        var string_length = 14;
        var randomstring = '';
        for (var i=0; i<string_length; i++) {
         var rnum = Math.floor(Math.random() * chars.length);
         randomstring += chars.substring(rnum,rnum+1);
        }
        setCode(randomstring)
      }
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
        data.code = code
        updateEpinMutate(data)
    }

    function closeModal() {
        setIsOpen(false)
    }

    useEffect(() => {
        if (epin) {
            reset(epin)
            setCode(epin?.code)
        }
    }, [epin])

    const {
        mutate: updateEpinMutate,
        isLoading,
    } = useMutation(updateEpin, {
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
                        Update Epin
                    </div>

                        <div className='px-6'>
                            <form onSubmit={handleSubmit(onSubmit)}>
                                <div className=" w-3/4 mx-auto">
                                <Textinput
                                        label="Epin Type/Name"
                                        placeholder="star"
                                        register={register}
                                        name="type"
                                        type="text"
                                        backendValidationError={backendError?.type}
                                        error={errors.type}
                                    />
                                   <div className="grid grid-cols-2 gap-2">
                                        <div className="formGroup">
                                            <label htmlFor="code" className='label-style'>Epin Code</label>
                                            <input
                                                type="text"
                                                value={code}
                                                onChange={handleCode}
                                                className="form-control"
                                                placeholder='FDSFSDF5646DFS'
                                            />
                                            {backendError && backendError?.code && (
                                                <p className="error-message">
                                                {backendError?.code}
                                                </p>
                                            )}
                                        </div>
                                        <div className='flax justify-center items-center'>
                                            <a href='#' onClick={generateCode} className="btn btn-primary" >Generate Code</a>
                                        </div>
                                   </div>
                                    <Textinput
                                        label="Epin Cost"
                                        placeholder="5000"
                                        register={register}
                                        name="cost"
                                        type="number"
                                        backendValidationError={backendError?.cost}
                                        error={errors.cost}
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

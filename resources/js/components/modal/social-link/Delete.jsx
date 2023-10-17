import { Dialog, Transition } from '@headlessui/react'
import { Fragment } from 'react'
import { AiFillCloseCircle, AiFillPlusCircle } from "react-icons/ai";
import { useMutation } from 'react-query';
import { deleteCategory } from '../../../hooks/queries/category';
import  toast  from 'react-hot-toast';
import { deleteSocialLink } from '../../../hooks/queries/social-link';

export default function DeleteCategory({isOpen, setIsOpen, closeModal, refatcher, category}) {


    const onSubmit= (data) => {
        deleteCategoryMutate(data)
    }
    function closeModal() {
        setIsOpen(false)
    }

    const {
        mutate: deleteCategoryMutate,
        isLoading,
    } = useMutation(deleteSocialLink, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right',
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
                        Delete Social Link
                    </div>

                        <div className='px-6'>

                                <div className=" w-3/4 mx-auto">

                                <h2 className="text-lg font-semibold pb-5">Delete this Social Link </h2>
                                <p className="text-gray-500 text-sm">
                                    Are you sure you want to delete this Social Link? All of your data will
                                    be permanently removed from our servers forever. This action
                                    cannot be undone.
                                </p>


                                    <div className='flex justify-end mt-4'>
                                        <div className='mr-3'>
                                        {isLoading ? (
                                            <>
                                            <button className="btn btn-danger flex justify-center align-center" type="button" disabled>
                                                <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Processing ...
                                            </button>
                                            </>
                                        ) : (
                                            <button onClick={() => onSubmit(category)} className=' cursor-pointer bg-red-500 text-white font-normal px-4 py-1 rounded-md' > Delete </button>
                                        )}
                                        </div>
                                        <div onClick={closeModal} className=" bg-indigo-700 text-white font-normal px-4 py-1 rounded-md cursor-pointer">
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

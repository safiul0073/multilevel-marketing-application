import { Dialog, Transition } from '@headlessui/react'
import { Fragment } from 'react'
import { getOneUser } from '../../../hooks/queries/user/getOneUser';
export default function InfoModal({isOpen, setIsOpen, closeModal, userId}) {

    const {data:user,} = getOneUser(userId)

    function closeModal() {
        setIsOpen(false)
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
                    <div className="flex justify-between items-center bg-indigo-700 text-white py-4 px-4 mb-6 font-medium text-lg rounded-t-[3px]">
                        <h1 className='text-center'>{user?.first_name + (user?.last_name ? user?.last_name : '')}</h1>
                        <button onClick={closeModal} className="outline-none text-red-600 hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-8 h-8">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                        
                        <div className='px-6'>
                            <div className=" w-3/4 mx-auto">

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

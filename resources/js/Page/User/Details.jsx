import { ArrowLeftIcon } from '@heroicons/react/24/outline'
import React from 'react'
import { Link } from 'react-router-dom'
import UserSideBar from '../../components/user/Sidebar'

export default function Details({showUserDetails, setUserDetails}) {
  return (
   <>

    <div className="container">
        <div className="sm:flex sm:items-center">
            <div className="sm:flex-auto flex items-center">
                <button
                    className="inline-flex items-center rounded border border-transparent bg-gray-200 p-1.5 text-black shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 mr-2"
                    onClick={() => setUserDetails(false)}
                >
                    <ArrowLeftIcon className="h-5 w-5" aria-hidden="true" />
                </button>
                <h1 className="text-xl font-semibold text-gray-900">
                User Details
                </h1>
            </div>
        </div>
        <div className="mt-8 flex flex-row">

        <UserSideBar />
        <div>
            {'tab' == 'info'}
        </div>

        </div>
    </div>


   </>
  )
}

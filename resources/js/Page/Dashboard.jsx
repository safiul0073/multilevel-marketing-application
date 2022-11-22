import React from 'react'
import { Link } from 'react-router-dom'
import { Logout } from '../helper/functions'
import { getLoggedOut } from '../hooks/queries/auth/auth'
import { useNavigate } from "react-router-dom";
import { UseStore } from '../store';
export const Dashboard = () => {
    const store = UseStore();
    let navigate = useNavigate();
    const logoutOption = () => {
        getLoggedOut()
        Logout()
        navigate("/staff/login");
    }
  return (
    <>

        <nav className="bg-white shadow-lg">
            <div className="max-w-6xl mx-auto px-4">
                <div className="flex justify-between">
                    <div className="flex space-x-7">

                        <div>
                            <a href="#" className="flex items-center py-4 px-2">
                                {/* <img src="logo.png" alt="Logo" className="h-8 w-8 mr-2" /> */}
                                <span className="font-semibold text-gray-500 text-lg"
                                    >Navigation</span
                                >
                            </a>
                        </div>

                        <div className="hidden md:flex items-center space-x-1">
                            <a
                                href=""
                                className="py-4 px-2 text-green-500 border-b-4 border-green-500 font-semibold "
                                >Home</a
                            >
                            <a
                                href=""
                                className="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300"
                                >Services</a
                            >
                            <a
                                href=""
                                className="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300"
                                >About</a
                            >
                            <a  onClick={logoutOption}
                                href="#"
                                className="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300"
                                >Logout</a
                            >
                        </div>

                       <div className='flex justify-center items-center'>
                            <h1>{store?.user?.first_name}</h1>
                       </div>
                    </div>
                </div>
            </div>
        </nav>
    </>
  )
}

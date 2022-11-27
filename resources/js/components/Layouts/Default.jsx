import React from 'react';
import { Link, Route, Routes } from 'react-router-dom';
import { Category } from '../../Page/Category';
import Dashboard from '../../Page/Dashboard';
import Login from '../Auth/Login';
import { Sidbar } from '../Sidbar';

const Layout =({children}) =>{
    return(
        <>
        <div className='min-h-full'>
            <Sidbar/>
            {/* <div className=' h-screen w-[160px] bg-cyan-800'>
                <ul className='flex flex-col items-center justify-center pt-12'>
                    <li className=' bg-cyan-100 px-4 py-3 rounded-lg my-2'><Link to="/staff">Dashboard</Link></li>
                    <li className=' bg-cyan-100 px-4 py-3 rounded-lg my-2'><Link to="/staff/category">Category</Link></li>
                    <li className=' bg-cyan-100 px-4 py-3 rounded-lg my-2'><Link to="/staff">Dashboard</Link></li>
                </ul>

            </div> */}
            <div>
            <Routes>
                <Route path="/staff" element={<Dashboard />} />
                <Route path="/staff/category" element={<Category />} />
                <Route path="/staff/login" element={<Login />} />
            </Routes>
            </div>

        </div>

        </>
    )
}

export default Layout;

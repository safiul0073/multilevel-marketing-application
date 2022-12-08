import React from 'react';
import { Route, Routes } from 'react-router-loading';
import Category from '../../Page/Category';
import Dashboard from '../../Page/Dashboard';
import Product from '../../Page/Product';
import User from '../../Page/User/Index';
import BinaryTree from '../../Page/User/BinaryTree';
import Slider from '../../Page/Slider';
import Login from '../Auth/Login';
import  Sidebar from '../Sidebar';
import Epin from '../../Page/Epin';

const Layout =() =>{

    return(
        <>
        <div className='min-h-full'>
            <Sidebar/>
            <div>
            <Routes >
                <Route path="/staff/dashboard" element={<Dashboard />} />
                <Route path="/staff/category" element={<Category />} />
                <Route path="/staff/slider" element={<Slider />} />
                <Route path="/staff/package" element={<Product />} />
                <Route path="/staff/users" element={<User />} />
                <Route path="/staff/binary-tree" element={<BinaryTree />} />
                <Route path="/staff/epin" element={<Epin />} />
                <Route path="/staff/login" element={<Login />} />
            </Routes>
            </div>

        </div>

        </>
    )
}

export default Layout;

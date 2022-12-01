import React from 'react';
import { Route, Routes } from 'react-router-dom';
import Category from '../../Page/Category';
import Dashboard from '../../Page/Dashboard';
import Product from '../../Page/Product';
import Slider from '../../Page/Slider';
import Login from '../Auth/Login';
import { Sidbar } from '../Sidbar';

const Layout =({children}) =>{
    return(
        <>
        <div className='min-h-full'>
            <Sidbar/>
            <div>
            <Routes>
                <Route path="/staff" element={<Dashboard />} />
                <Route path="/staff/category" element={<Category />} />
                <Route path="/staff/slider" element={<Slider />} />
                <Route path="/staff/package" element={<Product />} />
                <Route path="/staff/login" element={<Login />} />
            </Routes>
            </div>

        </div>

        </>
    )
}

export default Layout;

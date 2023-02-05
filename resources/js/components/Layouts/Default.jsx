import React, { useEffect } from 'react';
import { Route, Routes } from 'react-router-loading';
import Category from '../../Page/Category';
import Dashboard from '../../Page/Dashboard';
import Package from '../../Page/Package';
import User from '../../Page/User/Index';
import BinaryTree from '../../Page/User/BinaryTree';
import Slider from '../../Page/Slider';
import Login from '../Auth/Login';
import  Sidebar from '../Sidebar';
import Epin from '../../Page/Epin';
import Create from '../../Page/User/Create';
import { useNavigate } from 'react-router-dom';
import Reward from '../../Page/Reward';
import Incentive from '../../Page/Bonus/Incentive';
import Generation from '../../Page/Settings/Generation';
import IncentiveReport from '../../Page/Report/Incentive';
import GenerationReport from '../../Page/Report/Generation';
import JoiningReport from '../../Page/Report/Joining';
import MatchingReport from '../../Page/Report/Matching';
import WithdrawReport from '../../Page/Report/Withdraw';
import TopEarnedReport from '../../Page/Report/TopEarned';
import TopSponsorReport from '../../Page/Report/TopSponsor';
import Matching from '../../Page/Settings/Matching';
import SingleAmountSettings from '../../Page/Settings/SingleAmount'
import OfficeSettings from '../../Page/Settings/Office'
import HomeSettings from '../../Page/Settings/Home'
import PaymentMethod from '../../Page/PaymentMethod';
import Charge from '../../Page/Report/Charge';

const Layout =() =>{
    let navigate = useNavigate();
    useEffect(() => {
        if (window.location.pathname == '/staff') {
            navigate('/staff/dashboard')
        }
        return () => {}
    }, [])
    return(
        <>
        <div className='min-h-full'>
            <Sidebar/>
            <Routes >
                <Route path="/staff/dashboard" element={<Dashboard />} />
                <Route path="/staff/category" element={<Category />} />
                <Route path="/staff/slider" element={<Slider />} />
                <Route path="/staff/package" element={<Package />} />
                <Route path="/staff/users" element={<User />} />
                <Route path="/staff/users/binary-tree" element={<BinaryTree />} />
                <Route path="/staff/users/registration" element={<Create/>} />
                <Route path="/staff/reward" element={<Reward/>} />
                <Route path="/staff/payment-method" element={<PaymentMethod/>} />
                <Route path="/staff/bonus/incentive" element={<Incentive/>} />
                <Route path="/staff/reports/incentive" element={<IncentiveReport/>} />
                <Route path="/staff/reports/matching" element={<MatchingReport/>} />
                <Route path="/staff/reports/joining" element={<JoiningReport/>} />
                <Route path="/staff/reports/withdraw" element={<WithdrawReport/>} />
                <Route path="/staff/reports/generation" element={<GenerationReport/>} />
                <Route path="/staff/reports/top-earned" element={<TopEarnedReport/>} />
                <Route path="/staff/reports/top-sponsor" element={<TopSponsorReport/>}/>
                <Route path="/staff/reports/charges" element={<Charge/>} />
                <Route path="/staff/settings/generation" element={<Generation/>} />
                <Route path="/staff/settings/matching" element={<Matching/>} />
                <Route path="/staff/settings/single-amount" element={<SingleAmountSettings/>} />
                <Route path="/staff/settings/office-info" element={<OfficeSettings/>} />
                <Route path="/staff/settings/home-content" element={<HomeSettings/>} />
                <Route path="/staff/epin" element={<Epin />} />
                <Route path="/staff/login" element={<Login />} />
            </Routes>
            </div>
        </>
    )
}
export default Layout;

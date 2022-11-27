import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom/client';
import {
    QueryClient,
    QueryClientProvider,
  } from 'react-query'
import Layout from '../components/Layouts/Default';
import Cookies from 'js-cookie';
import { getUsers } from '../hooks/queries/auth/auth';
import { updateAxiosToken } from '../config/axios.config';
import { UseStore } from '../store';
import Dashboard from './Dashboard';
import Login from '../components/Auth/Login'
import { BrowserRouter, Route, Router, Routes } from 'react-router-dom';
import AuthLayout from '../components/Layouts/Auth';
import ProgressBar from "@badrap/bar-of-progress";

function Index() {

    const progress = new ProgressBar({
        size: 4,
        color: "#38a169",
        className: "bar-of-progress",
        delay: 100,
      });
      
    const {isAuth, setAuth, setUser} = UseStore();
    const queryClient = new QueryClient()
    const token = Cookies.get('nAToken')
    async function callUserData () {
       let data = await getUsers()
       if (data?.data?.json_object) {
        setUser(data?.data?.json_object)
        setAuth(true)
       }
    }
    console.log(isAuth)
    useEffect (() => {
        if (!!token) {
            updateAxiosToken(token)
            callUserData()
        }
    },[token])

    return (
        <>
        <QueryClientProvider client={queryClient}>
            {isAuth ?
                    <Layout>
                        <BrowserRouter>
                            <Routes>
                                <Route path="/staff" element={<Dashboard />} />
                                <Route path="/staff/login" element={<Login />} />
                            </Routes>
                        </BrowserRouter>
                    </Layout>

                :
                <AuthLayout>
                    <BrowserRouter>
                        <Routes>
                            <Route path="/staff" element={<Dashboard />} />
                            <Route path="/staff/login" element={<Login />} />
                        </Routes>
                    </BrowserRouter>
                </AuthLayout>
            }
        </QueryClientProvider>
        </>
    );
}

export default Index;

if (document.getElementById('root')) {
    const rootId = ReactDOM.createRoot(document.getElementById("root"));

    rootId.render(
        <React.StrictMode>
            <Index/>
        </React.StrictMode>
    )
}

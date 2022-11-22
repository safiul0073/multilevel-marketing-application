import React, { useEffect } from 'react';
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
function Index() {
    const store = UseStore();
    const queryClient = new QueryClient()
    const token = Cookies.get('nAToken')
    async function callUserData () {
       let data = await getUsers()
       if (data?.data?.json_object) {
        store.setUser(data?.data?.json_object)
       }
    }
    useEffect (() => {
        console.log(token)
        if (!!token) {
            updateAxiosToken(token)
            callUserData()
        }
    },[token])
    return (
        <>
        <QueryClientProvider client={queryClient}>
            <Layout/>
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

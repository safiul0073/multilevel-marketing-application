import React, { useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import { Login } from '../components/Auth/Login';
import Layout from '../components/Layouts/Default';
import {
    QueryClient,
    QueryClientProvider,
  } from 'react-query'
import AuthProvider from '../context/AuthContext';

function Index() {
    const queryClient = new QueryClient()
    return (
        <>
            <AuthProvider>
                <QueryClientProvider client={queryClient}>
                    <Layout>
                        <Login/>
                    </Layout>
                </QueryClientProvider>
            </AuthProvider>
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

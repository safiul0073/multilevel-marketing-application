import React from 'react';
import ReactDOM from 'react-dom/client';
import { Login } from '../components/Auth/Login';
import Layout from '../components/Layouts/Default';
import {
    QueryClient,
    QueryClientProvider,
  } from 'react-query'

function Index() {

    const queryClient = new QueryClient()
    return (
        <>
            <QueryClientProvider client={queryClient}>
                <Layout>
                    <Login/>
                </Layout>
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

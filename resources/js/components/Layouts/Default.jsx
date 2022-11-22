import React from 'react';
import { BrowserRouter } from "react-router-dom";
import Protected from '../HOC/Protected';
import { Router } from '../Router';

const Layout =() =>{

    return(
        <>
        <div>
        <BrowserRouter>
            <Router />
        </BrowserRouter>
        </div>

        </>
    )
}

export default Layout;

import React, { useEffect } from 'react';
import Login from '../Auth/Login';
import Cookies from 'js-cookie';
import { BrowserRouter } from "react-router-dom";
import { Router } from '../Router';
import { useAuth } from '../../context/AuthContext';
import { useNavigate } from "react-router-dom";
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

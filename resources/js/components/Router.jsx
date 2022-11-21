import Cookies from "js-cookie";
import { useEffect, useState } from "react";
import { Routes, Route } from "react-router-dom";
import { Dashboard } from "../Page/Dashboard";
import Login from "./Auth/Login";
import { useNavigate } from "react-router-dom";
export const Router = () => {
    let navigate = useNavigate();
    let token =Cookies.get('nAToken')
    const [isAuthenticated, setAuthenticated] = useState(false)
    useEffect (() =>{
        if (token) {
            navigate("/staff");
        }else{
            navigate("/staff/login");
        }
    }, [token])
  return (
        <>
            <Routes>
                <Route path="/staff" element={<Dashboard />} />
                <Route path="/staff/login" element={<Login />} />
            </Routes>
        </>
  );
};

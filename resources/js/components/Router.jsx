import Cookies from "js-cookie";
import { useEffect, useState } from "react";
import { Routes, Route } from "react-router-dom";
import Dashboard from '../Page/Dashboard'
import Login from "./Auth/Login";

export const Router = () => {

  return (
        <>
            <Routes>
                <Route path="/staff" element={<Dashboard />} />
                <Route path="/staff/login" element={<Login />} />
            </Routes>
        </>
  );
};

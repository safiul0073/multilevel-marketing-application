import React from 'react'
import { Link } from 'react-router-dom'
import { Logout } from '../helper/functions'
import { getLoggedOut } from '../hooks/queries/auth/auth'
import { useNavigate } from "react-router-dom";
export const Dashboard = () => {
    let navigate = useNavigate();
    const logoutOption = () => {
        getLoggedOut()
        Logout()
        navigate("/staff/login");
    }
  return (
    <div>
        <div>
            <nav>
                <ul>
                    <li><Link to="/staff/dashboard">Login</Link></li>
                    <li><Link to="/staff/category">Category</Link></li>
                    <li><button onClick={logoutOption} >Logout</button></li>
                </ul>
            </nav>
        </div>
    </div>
  )
}


import React, { useEffect } from 'react'
import { useNavigate } from 'react-router-dom';

export default function AuthLayout ({children}) {
    let navigate = useNavigate();
    useEffect(() => {
        if (window.location.pathname == '/staff') {
            navigate('/staff/dashboard')
        }
        return () => {}
    }, [])
  return (
    <div>
        {/* only login component using this layout */}
        {children}
    </div>
  )
}

import Cookies from 'js-cookie'
import React, { useEffect } from 'react'

export const ResetPassword = () => {
  useEffect(() => {
    let code = Cookies.get("otp");
    console.log(code);
  
    // return () => {
    //   // second
    // }
  }, [])
  
  return (
    <div>
        enter new password page
    </div>
  )
}

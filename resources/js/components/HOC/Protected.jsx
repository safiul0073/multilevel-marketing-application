import Cookies from "js-cookie";
import { useEffect, useState } from "react";
const Protected = (ProtectedComponent) => {

    return (props) => {

            const [isTrue, setTrue] = useState(false)

            useEffect(() => {
                    let token = Cookies.get('nAToken')
                    if (!!token) {
                        setTrue(true)
                    }else {
                        window.location.href = '/staff/login';
                    }

            }, [])

        return isTrue ? <ProtectedComponent {...props} /> : null;
    };
};

export default Protected;

import Cookies from "js-cookie";
import { UseStore } from "../../store";
import { useEffect, useState } from "react";
const Protected = (ProtectedComponent) => {

    return (props) => {

            const [isTrue, setTrue] = useState(false)
            let store = UseStore()

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

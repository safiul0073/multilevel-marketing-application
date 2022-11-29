import Cookies from "js-cookie";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { UseStore } from "../../store";
const Protected = (ProtectedComponent) => {

    return (props) => {

            const [isTrue, setTrue] = useState(false)
            let navigate = useNavigate();
            let {isAuth} = UseStore()
            useEffect(() => {
                    let token = Cookies.get('nAToken')
                    if (!!token) {
                        setTrue(true)
                    }else {
                        navigate('/staff/login');
                    }

            }, [])

        return isTrue ? <ProtectedComponent {...props} /> : null;
    };
};

export default Protected;

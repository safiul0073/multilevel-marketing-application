import Cookies from "js-cookie";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { TOKEN_NAME } from "../../constant";

const Protected = (ProtectedComponent) => {
    return (props) => {
        const [isTrue, setTrue] = useState(false);
        let navigate = useNavigate();
        useEffect(() => {
            let token = Cookies.get(TOKEN_NAME);
            if (!!token) {
                setTrue(true);
            } else {
                navigate("/staff/login");
            }
        }, []);

        return isTrue ? <ProtectedComponent {...props} /> : null;
    };
};

export default Protected;

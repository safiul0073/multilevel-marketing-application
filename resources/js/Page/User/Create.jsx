import React, { useMemo, useState } from "react";
import Protected from "../../components/HOC/Protected";
import OrderSummary from "../../components/user/registration/OrderSummary";
import SponsorPackage from "../../components/user/registration/Sponsor&Package/Index";
import UserInfo from "../../components/user/registration/UserInfo";

const Create = () => {

    const [tab, setTab] = useState('sponsor')
    const [backendError, setBackendError] = useState()
    const switchPage = (tab) => {
        if (tab === 'sponsor') {
            return (<SponsorPackage backendError={backendError} setTab={setTab} />)
        } else if (tab === 'userInfo') {
            return (<UserInfo backendError={backendError} setTab={setTab} />)
        } else {
            return (<OrderSummary setBackendError={setBackendError} backendError={backendError} setTab={setTab} />)
        }
    }
    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        {switchPage(tab)}
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Create);

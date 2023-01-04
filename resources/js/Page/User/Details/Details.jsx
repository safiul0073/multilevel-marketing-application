import React from "react";
import Balance from "../../../components/user/Details/Balance";
import UpdateForm from "../../../components/user/Details/UpdateForm";



const Details = ({ details, detailsRefetch }) => {

    return (
        <>
            <Balance details={details} />
            <UpdateForm details={details} detailsRefetch={detailsRefetch} />
        </>
    );
};

export default Details;

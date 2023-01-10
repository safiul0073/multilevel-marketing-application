import React from "react";
import TreeView from "../../../components/user/tree/TreeView";

const ReferralTree = ({ username }) => {
    return (
        <>
            <TreeView username={username} />
        </>
    );
};

export default ReferralTree;

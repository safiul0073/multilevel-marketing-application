import React from "react";

const SecondaryButton = ({ title, onclick }) => {
    return (
        <button onClick={onclick} className="btn btn-secondary uppercase">
            {title}
        </button>
    );
};

export default SecondaryButton;

import React from "react";

const DateField = ({ label, value, setValue }) => {
    return (
        <div className="flex gap-1 items-center">
            <label className="label-style" htmlFor="fromDate">
                {`${label} `}
            </label>
            <input
                id="fromDate"
                type="date"
                className="form-control"
                value={value}
                onChange={(e) => setValue(e.target.value)}
            />
        </div>
    );
};

export default DateField;

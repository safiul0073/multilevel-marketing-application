import React from "react";
import DateField from "./DateField";

const TwoDateField = ({ fromDate, setFromDate, toDate, setToDate }) => {
    return (
        <div className="lg:grid grid-cols-2 gap-2">
            <DateField label="To" value={fromDate} setValue={setFromDate} />
            <DateField label="To" value={toDate} setValue={setToDate} />
        </div>
    );
};

export default TwoDateField;

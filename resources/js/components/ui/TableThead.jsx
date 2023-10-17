import React from "react";

const TableThead = ({ labels }) => {
    const firstPositionStyle = "py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
    const everyPositionStyle = "px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
    return (
        <tr>
            {labels.map((val, idx) => (
                <th key={idx}
                    scope="col"
                    className={idx === 0 ? firstPositionStyle : everyPositionStyle}
                >
                    {val.label}
                </th>
            ))}
        </tr>
    );
};

export default TableThead;

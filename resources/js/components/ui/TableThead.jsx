import React from "react";

const TableThead = ({ labels }) => {
    const firstPositionStyle = "py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
    const everyPositionStyle = "px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
    return (
        <tr>
            {Object.entries(labels).map((label, idx) => (
                <th
                    scope="col"
                    className={idx === 0 ? firstPositionStyle : everyPositionStyle}
                >
                    {label[1]}
                </th>
            ))}
        </tr>
    );
};

export default TableThead;

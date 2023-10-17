import moment from "moment";
import React from "react";

const TableBody = ({ data, labels }) => {
    const firstTdStyle =
        "whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6";
    const everyPositionStyle =
        "whitespace-nowrap px-3 py-4 text-sm text-gray-500";

    const placeData = (obj, key) => {
        let value = obj[key];
        if (key.includes(".")) {
            value = eval("obj." + key);
        }

        if (value) {
            if (key == "created_at") {
                value = (
                    <>
                        <div>
                            {moment(obj[key]).format("MMMM DD YYYY, h:mm:ss a")}
                        </div>
                        <div>{moment(obj[key]).fromNow()}</div>
                    </>
                );
            }

            return value;
        }
    };

    return (
        <>
            {data.map((d, index) => (
                <tr key={Math.random()}>
                    {labels.map((val, idx) => (
                        <td
                            key={idx}
                            className={
                                idx === 0 ? firstTdStyle : everyPositionStyle
                            }
                        >
                            {placeData(d, val.key)}
                        </td>
                    ))}
                </tr>
            ))}
        </>
    );
};

export default TableBody;

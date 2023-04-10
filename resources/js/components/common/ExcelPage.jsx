import React from "react";
import {
    ExcelExport,
    ExcelExportColumn,
    ExcelExportColumnGroup,
} from "@progress/kendo-react-excel-export";
const cellOptions = {
    fontSize: 12,
    textAlign: "left",
};

const headerOptions = {
    background: "#fff",
    textAlign: "center",
    fontSize: 16,

    color: "#000",
    bold: true,
    borderLeft: {
        color: "#000",
        size: 1,
    },
    borderRight: {
        color: "#000",
        size: 1,
    },
    borderBottom: {
        color: "#000",
        size: 1,
    },
    borderTop: {
        color: "#000",
        size: 1,
    },
};
const headerOptions2 = {
    background: "#fff",
    textAlign: "left",
    fontSize: 12,
    color: "#000",
    borderLeft: {
        color: "#AAABA9",
        size: 1,
    },
    borderRight: {
        color: "#AAABA9",
        size: 1,
    },
    borderBottom: {
        color: "#AAABA9",
        size: 1,
    },
    borderTop: {
        color: "#AAABA9",
        size: 1,
    },
};
const ExcelPage = ({ data, _exporter, labels, fileName="Reports" }) => {
    return (
        <div>
            <ExcelExport data={data} fileName={fileName} ref={_exporter}>
                {Object.entries(labels).map((lab, idx) => (
                    <ExcelExportColumn
                        key={idx}
                        field={lab[0]}
                        title={lab[1]}
                        headerCellOptions={headerOptions}
                        cellOptions={cellOptions}
                    />
                ))}
            </ExcelExport>
        </div>
    );
};

export default ExcelPage;

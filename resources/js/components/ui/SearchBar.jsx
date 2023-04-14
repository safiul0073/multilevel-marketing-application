import React, { useState } from "react";
import SearchInput from "./SearchInput";
import Datepicker from "react-tailwindcss-datepicker";
import SecondaryButton from "./SecondaryButton";
import Swal from "sweetalert2";
import ExcelPage from "../common/ExcelPage";
import generatePDF from "../../services/generatePdf";

const SearchBar = ({
    title,
    setFromDate,
    setToDate,
    searchKeyword,
    setSearchKeyword,
    data,
    labels,
    reportName,
    inputSearchPlaceHolder = "username",
}) => {
    const [value, setValue] = useState({
        startDate: null,
        endDate: null,
    });
    const handleValueChange = (newValue) => {
        setValue(newValue);
        setFromDate(newValue.startDate);
        setToDate(newValue.endDate);
    };

    const _exporter = React.createRef();
    const excelExport = () => {
        if (notFoundShow(data)) return;
        if (_exporter.current) {
            _exporter.current.save();
        }
    };

    const exportPdf = () => {
        if (notFoundShow(data)) return;
        generatePDF(data, labels, title, reportName);
    };

    const notFoundShow = () => {
        if (data?.length <= 0) {
            Swal.fire({
                icon: "error",
                title: "Not Found",
                text: "data not found!",
            });
            return true;
        }
        return false;
    };
    return (
        <>
            <ExcelPage
                data={data}
                _exporter={_exporter}
                fileName={reportName}
                labels={labels}
            />
            <div className="bg-gray-100 p-3 rounded-md">
                <div className="lg:flex justify-between items-center">
                    <h1 className="text-lg font-normal text-gray-900 py-1">
                        {title}
                    </h1>
                    <Datepicker
                        placeholder="From - To"
                        inputClassName="w-full outline-none font-normal bg-green-100 dark:bg-green-900 dark:placeholder:text-green-100"
                        containerClassName="w-64 py-1"
                        value={value}
                        onChange={handleValueChange}
                    />
                    <SearchInput
                        type="text"
                        placeholder={inputSearchPlaceHolder}
                        value={searchKeyword}
                        className="py-1"
                        onChange={(e) => setSearchKeyword(e.target.value)}
                    />
                    <div className="py-2 flex gap-2">
                        <SecondaryButton title="excel" onclick={excelExport} />
                        <SecondaryButton title="pdf" onclick={exportPdf} />
                    </div>
                </div>
            </div>
        </>
    );
};

export default SearchBar;

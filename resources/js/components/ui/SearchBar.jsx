import React from "react";
import SearchInput from "./SearchInput";
import TwoDateField from "./TwoDateField";

const SearchBar = ({
    title,
    inputSearchPlaceHolder = "username",
    fromDate,
    setFromDate,
    toDate,
    setToDate,
    searchKeyword,
    setSearchKeyword,
}) => {
    return (
        <div className="bg-gray-100 p-3 rounded-md">
            <div className="lg:flex justify-between items-center">
                <h1 className="text-lg font-normal text-gray-900">{title}</h1>
                <TwoDateField
                    fromDate={fromDate}
                    setFromDate={setFromDate}
                    toDate={toDate}
                    setToDate={setToDate}
                />

                <SearchInput
                    type="text"
                    placeholder={inputSearchPlaceHolder}
                    value={searchKeyword}
                    onChange={(e) => setSearchKeyword(e.target.value)}
                />
            </div>
            <div className="py-2 flex justify-end gap-2">
                <button className="btn btn-secondary uppercase">excel</button>
                <button className="btn btn-secondary uppercase">print</button>
                <button className="btn btn-secondary uppercase">pdf</button>
            </div>
        </div>
    );
};

export default SearchBar;

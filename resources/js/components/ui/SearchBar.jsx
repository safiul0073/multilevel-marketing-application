import React, { useState } from "react";
import SearchInput from "./SearchInput";
import Datepicker from "react-tailwindcss-datepicker";
import SecondaryButton from "./SecondaryButton";

const SearchBar = ({
    title,
    inputSearchPlaceHolder = "username",
    setFromDate,
    setToDate,
    searchKeyword,
    setSearchKeyword,
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
    return (
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
                    <SecondaryButton
                        title="excel"
                        onclick={() => console.log("hello excel")}
                    />
                    <SecondaryButton
                        title="pdf"
                        onclick={() => console.log("hello pdf")}
                    />
                </div>
            </div>
        </div>
    );
};

export default SearchBar;

import React from "react";

const SearchInput = ({
    type,
    value,
    onChange,
    className = "",
    placeholder = "Search",
}) => {
    return (
        <div>
            <input
                className={`w-64 h-12 mx-auto rounded-[60px] border-2 placeholder:text-left outline-none p-5 ${className}`}
                type={type}
                value={value}
                onChange={onChange}
                placeholder={placeholder}
            />
        </div>
    );
};

export default SearchInput;

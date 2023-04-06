import React from "react";

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
                <div className="lg:grid grid-cols-2 gap-2">
                    <div className="flex gap-1 items-center">
                        <label className="label-style" for="fromDate">
                            From:{" "}
                        </label>
                        <input
                            id="fromDate"
                            type="date"
                            className="form-control"
                            value={fromDate}
                            onChange={(e) => setFromDate(e.target.value)}
                        />
                    </div>
                    <div className="flex gap-1 items-center">
                        <label className="label-style" for="fromDate">
                            To:{" "}
                        </label>
                        <input
                            id="fromDate"
                            type="date"
                            className="form-control"
                            value={toDate}
                            onChange={(e) => setToDate(e.target.value)}
                        />
                    </div>
                </div>
                <div>
                    <input
                        type="text"
                        className="form-control"
                        placeholder={inputSearchPlaceHolder}
                        value={searchKeyword}
                        onChange={(e) => setSearchKeyword(e.target.value)}
                    />
                </div>
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

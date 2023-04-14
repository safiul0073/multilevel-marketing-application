import React from "react";
import LoaderAnimation from "../common/LoaderAnimation";
import Pagination from "../common/Pagination";
import RowNotFound from "../common/RowNotFound";
import TableThead from "./TableThead";

const TableBlock = ({
    pageName,
    isLoading,
    totalDataCount,
    page,
    setPage,
    pageSize,
    setPageSize,
    dataLength,
    children,
    labels,
}) => {
    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum);
        setPageSize(() => currentPageValue);
    };

    return (
        <div className="mt-8 flex flex-col">
            <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                    {isLoading ? (
                        <LoaderAnimation />
                    ) : (
                        <>
                            {dataLength ? (
                                <>
                                    <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table className="min-w-full divide-y divide-gray-300">
                                            <thead className="bg-gray-50">
                                                <TableThead labels={labels} />
                                            </thead>
                                            <tbody className="divide-y divide-gray-200 bg-white">
                                                {children}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div className="my-4">
                                        <Pagination
                                            total={totalDataCount}
                                            pageSize={pageSize}
                                            pageNumber={page}
                                            handlePageChange={handlePageChange}
                                        />
                                    </div>
                                </>
                            ) : (
                                <RowNotFound name={pageName} />
                            )}
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};

export default TableBlock;

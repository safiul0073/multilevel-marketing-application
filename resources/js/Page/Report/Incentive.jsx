import moment from "moment";
import React from "react";
import ExcelPage from "../../components/common/ExcelPage";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import SearchBar from "../../components/ui/SearchBar";
import { useDebounce } from "../../hooks/others/useDebounce";
import { getIncentiveBonus } from "../../hooks/queries/bonus/getIncentiveBonus";
import { getIncentiveBonusExcel } from "../../hooks/queries/bonus/getIncentiveBonusExcel";
import Swal from "sweetalert2";

const labels = {
    id: "id",
    from_date: "From Date",
    to_date: "To Date",
    count: "Members",
    amount: "Amount",
    created_at: "Given Date",
};

const Incentive = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState("");
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum);
        setPageSize(() => currentPageValue);
    };

    const { data: incentives, isLoading } = getIncentiveBonus({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize,
    });

    const { data: incentiveExcelData } = getIncentiveBonusExcel({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
    });

    const _exporter = React.createRef();
    const excelExport = () => {
        if (incentiveExcelData?.length <= 0) {
            Swal.fire({
                icon: "error",
                title: "Not Found",
                text: "data not found!",
            });
            return null;
        }

        if (_exporter.current) {
            _exporter.current.save();
        }
    };

    return (
        <>
            <ExcelPage data={incentiveExcelData} _exporter={_exporter} labels={labels} />
            <Card
                headerSlot={
                    <SearchBar
                        title="Daily Incentive List"
                        inputSearchPlaceHolder="amount"
                        fromDate={fromDate}
                        toDate={toDate}
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        excelExport={excelExport}
                    />
                }
            >
                <div className="mt-8 flex flex-col">
                    <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                            {isLoading ? (
                                <LoaderAnimation />
                            ) : (
                                <>
                                    {incentives?.data?.length ? (
                                        <>
                                            <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                                <table className="min-w-full divide-y divide-gray-300">
                                                    <thead className="bg-gray-50">
                                                        <tr>
                                                            <th
                                                                scope="col"
                                                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                            >
                                                                ID
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                From Date
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                To Date
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                Members
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                Amount
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                Given Date
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody className="divide-y divide-gray-200 bg-white">
                                                        {incentives?.data?.map(
                                                            (incentive) => (
                                                                <tr
                                                                    key={Math.random()}
                                                                >
                                                                    <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                                        {
                                                                            incentive?.id
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {
                                                                            incentive?.from_date
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {
                                                                            incentive?.to_date
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {
                                                                            incentive?.count
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {
                                                                            incentive?.amount
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        <div>
                                                                            {moment(
                                                                                incentive?.created_at
                                                                            ).format(
                                                                                "MMMM Do YYYY, h:mm:ss a"
                                                                            )}
                                                                        </div>
                                                                        <div>
                                                                            {moment(
                                                                                incentive?.created_at
                                                                            ).fromNow()}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            )
                                                        )}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div className="my-4">
                                                <Pagination
                                                    total={incentives?.total}
                                                    pageSize={pageSize}
                                                    pageNumber={page}
                                                    handlePageChange={
                                                        handlePageChange
                                                    }
                                                />
                                            </div>
                                        </>
                                    ) : (
                                        <RowNotFound name="incentives" />
                                    )}
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </Card>
        </>
    );
};

export default Protected(Incentive);

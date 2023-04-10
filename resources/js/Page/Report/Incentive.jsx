import moment from "moment";
import React from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import SearchBar from "../../components/ui/SearchBar";
import TableBlock from "../../components/ui/TableBlock";
import { useDebounce } from "../../hooks/others/useDebounce";
import { getIncentiveBonus } from "../../hooks/queries/bonus/getIncentiveBonus";
import { getIncentiveBonusExcel } from "../../hooks/queries/bonus/getIncentiveBonusExcel";

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

    const thead = (
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
    );

    const tbody = (
        <>
            {incentives?.data?.map((incentive) => (
                <tr key={Math.random()}>
                    <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                        {incentive?.id}
                    </td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {incentive?.from_date}
                    </td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {incentive?.to_date}
                    </td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {incentive?.count}
                    </td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {incentive?.amount}
                    </td>
                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <div>
                            {moment(incentive?.created_at).format(
                                "MMMM Do YYYY, h:mm:ss a"
                            )}
                        </div>
                        <div>{moment(incentive?.created_at).fromNow()}</div>
                    </td>
                </tr>
            ))}
        </>
    );

    return (
        <>
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
                        data={incentiveExcelData}
                        labels={labels}
                    />
                }
            >
                <TableBlock
                    pageName="incentives"
                    isLoading={isLoading}
                    totalDataCount={incentives?.total}
                    page={page}
                    setPage={setPage}
                    pageSize={pageSize}
                    setPageSize={setPageSize}
                    dataLength={incentives?.data?.length}
                    thead={thead}
                    tbody={tbody}
                />
            </Card>
        </>
    );
};

export default Protected(Incentive);

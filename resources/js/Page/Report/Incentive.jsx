import moment from "moment";
import React from "react";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import SearchBar from "../../components/ui/SearchBar";
import TableBlock from "../../components/ui/TableBlock";
import TableBody from "../../components/ui/TableBody";
import { useDebounce } from "../../hooks/others/useDebounce";
import { getIncentiveBonus } from "../../hooks/queries/bonus/getIncentiveBonus";
import { getIncentiveBonusExcel } from "../../hooks/queries/bonus/getIncentiveBonusExcel";

const labels = [
    { key: "id", label: "id" },
    { key: "from_date", label: "From Date" },
    { key: "to_date", label: "To Date" },
    { key: "count", label: "Members" },
    { key: "amount", label: "Amount" },
    { key: "created_at", label: "Given Date" },
];

const Incentive = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
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

    return (
        <>
            <Card
                headerSlot={
                    <SearchBar
                        title="Daily Incentive List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={incentiveExcelData}
                        labels={labels}
                        reportName="Day_incentive_report"
                        inputSearchPlaceHolder="amount"
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
                    labels={labels}
                >
                    <TableBody data={incentives?.data} labels={labels} />
                </TableBlock>
            </Card>
        </>
    );
};

export default Protected(Incentive);

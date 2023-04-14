import moment from "moment";
import React from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import SearchBar from "../../components/ui/SearchBar";
import TableBlock from "../../components/ui/TableBlock";
import TableBody from "../../components/ui/TableBody";
import { useDebounce } from "../../hooks/others/useDebounce";
import { getDailyIncentive } from "../../hooks/queries/reports/getDailyIncentive";
import { getDailyIncentiveExcel } from "../../hooks/queries/reports/getDailyIncentiveExcel";

const labels = [
    { key: "id", label: "Id" },
    { key: "bonus_got.username", label: "Who Got" },
    { key: "amount", label: "Amount" },
    { key: "created_at", label: "When" },
];

const DailyIncentive = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const { data: incentiveIncome, isLoading } = getDailyIncentive({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize,
    });

    const { data: incomeExcelData } = getDailyIncentiveExcel({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
    });
    return (
        <>
            <Card
                headerSlot={
                    <SearchBar
                        title="Daily Income List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={incomeExcelData}
                        labels={labels}
                        reportName="daily_income_report"
                        inputSearchPlaceHolder="username"
                    />
                }
            >
                <TableBlock
                    pageName="income"
                    isLoading={isLoading}
                    totalDataCount={incentiveIncome?.total}
                    page={page}
                    setPage={setPage}
                    pageSize={pageSize}
                    setPageSize={setPageSize}
                    dataLength={incentiveIncome?.data?.length}
                    labels={labels}
                >
                    <TableBody data={incentiveIncome?.data} labels={labels} />
                </TableBlock>
            </Card>
        </>
    );
};

export default Protected(DailyIncentive);

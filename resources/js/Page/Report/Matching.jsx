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
import { getBonus } from "../../hooks/queries/bonus/getBonus";
import { getBonusExcel } from "../../hooks/queries/bonus/getBonusExcel";

const labels = [
    { key: "id", label: "Id" },
    { key: "bonus_got.username", label: "Who Got" },
    { key: "amount", label: "Amount" },
    { key: "created_at", label: "When" },
];

const Matching = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const { data: matchings, isLoading } = getBonus({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        status: "matching",
        page: page,
        perPage: pageSize,
    });

    const { data: matchingExcel } = getBonusExcel({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        status: "matching",
    });

    return (
        <>
            <Card
                headerSlot={
                    <SearchBar
                        title="Matching Bonus List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={matchingExcel}
                        labels={labels}
                        reportName="matching_bonus_report"
                        inputSearchPlaceHolder="username"
                    />
                }
            >
                <TableBlock
                    pageName="matching"
                    isLoading={isLoading}
                    totalDataCount={matchings?.total}
                    page={page}
                    setPage={setPage}
                    pageSize={pageSize}
                    setPageSize={setPageSize}
                    dataLength={matchings?.data?.length}
                    labels={labels}
                >
                    <TableBody data={matchings?.data} labels={labels} />
                </TableBlock>
            </Card>
        </>
    );
};

export default Protected(Matching);

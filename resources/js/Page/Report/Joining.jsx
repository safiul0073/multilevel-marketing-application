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
    { key: "bonus_for.username", label: "For Whom" },
    { key: "bonus_for.sponsor.username", label: "Placement Id" },
    { key: "placementType", label: "Placement Type" },
    { key: "amount", label: "Amount" },
    { key: "created_at", label: "When" },
];

const Joining = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const { data: joinings, isLoading } = getBonus({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        status: "joining",
        page: page,
        perPage: pageSize,
    });

    const { data: joiningExcel } = getBonusExcel({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        status: "joining",
    });

    const joiningData = React.useMemo(() => {
        return joinings?.data?.map((data) => {
            return {
                ...data,
                placementType:
                    data?.bonus_for?.id == data?.bonus_for?.sponsor?.left_ref_id
                        ? "Left"
                        : "Right",
            };
        });
    }, [joinings]);

    const joiningExcelData = React.useMemo(() => {
        return joiningExcel?.map((data) => {
            return {
                ...data,
                placementType:
                    data?.bonus_for?.id == data?.bonus_for?.sponsor?.left_ref_id
                        ? "Left"
                        : "Right",
            };
        });
    }, [joiningExcel]);
    return (
        <>

            <Card
                headerSlot={
                    <SearchBar
                        title="Joining Bonus List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={joiningExcelData}
                        labels={labels}
                        reportName="joining_bonus_report"
                        inputSearchPlaceHolder="username"
                    />
                }
            >
                <TableBlock
                    pageName="joinings"
                    isLoading={isLoading}
                    totalDataCount={joinings?.total}
                    page={page}
                    setPage={setPage}
                    pageSize={pageSize}
                    setPageSize={setPageSize}
                    dataLength={joinings?.data?.length}
                    labels={labels}
                >
                    <TableBody data={joiningData} labels={labels} />
                </TableBlock>
            </Card>
        </>
    );
};

export default Protected(Joining);

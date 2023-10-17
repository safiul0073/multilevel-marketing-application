import moment from "moment";
import React from "react";
import toast from "react-hot-toast";
import { useMutation } from "react-query";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import SearchBar from "../../components/ui/SearchBar";
import TableBlock from "../../components/ui/TableBlock";
import TableBody from "../../components/ui/TableBody";
import { useDebounce } from "../../hooks/others/useDebounce";
import { getCharges } from "../../hooks/queries/reports/getCharges";

const labels = [
    { key: "id", label: "Id" },
    { key: "type", label: "Type" },
    { key: "amount", label: "Amount" },
    { key: "created_at", label: "Date" },
];

const Charge = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum);
        setPageSize(() => currentPageValue);
    };

    const {
        data: charges,
        isLoading,
        refetch,
    } = getCharges({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        isNotPaginate: true,
        page: page,
        perPage: pageSize,
    });

    const { data: excelData } = getCharges({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        isNotPaginate: true,
        page: page,
        perPage: pageSize,
    });

    const mappedObj = (d) => {
        return {
            ...d,
            username: d?.holder?.user?.username,
            created_at: d?.holder?.created_at,
        };
    };

    const tableMappedData = React.useMemo(() => {
        return charges?.data?.map((d) => {
            return mappedObj(d);
        });
    }, [charges]);

    const excelMappedData = React.useMemo(() => {
        return excelData?.map((d) => {
            return mappedObj(d);
        });
    }, [excelData]);

    return (
        <>
            <Card
                headerSlot={
                    <SearchBar
                        title="Charges List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={excelMappedData}
                        labels={labels}
                        reportName="charges_report"
                        inputSearchPlaceHolder="username"
                    />
                }
            >
                <TableBlock
                    pageName="income"
                    isLoading={isLoading}
                    totalDataCount={charges?.total}
                    page={page}
                    setPage={setPage}
                    pageSize={pageSize}
                    setPageSize={setPageSize}
                    dataLength={charges?.data?.length}
                    labels={labels}
                >
                    <TableBody data={tableMappedData} labels={labels} />
                </TableBlock>
            </Card>
        </>
    );
};

export default Protected(Charge);

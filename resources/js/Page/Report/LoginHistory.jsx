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
import { getLoginHistory } from "../../hooks/queries/reports/getLoginHistory";
import { getLoginHistoryExcel } from "../../hooks/queries/reports/getLoginHistoryExcel";

const labels = [
    { key: "id", label: "id" },
    { key: "username", label: "Username" },
    { key: "ip", label: "Ip" },
    { key: "location", label: "Location" },
    { key: "device", label: "Device | OS" },
    { key: "login_time", label: "Login Time" },
];

const LoginHistory = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const { data: data, isLoading } = getLoginHistory({
        from_date: "",
        to_date: "",
        page: page,
        perPage: pageSize,
    });
    const { data: excelData } = getLoginHistoryExcel({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
    });

    const tableMappedData = React.useMemo(() => {
        return data?.data?.map((d) => {
            return {
                ...d,
                username: d?.user?.username,
                ip: d?.ip,
                location:
                    d?.location?.regionName + ", " + d?.location?.countryName,
                device: d?.agent?.browser + ", " + d?.agent?.platform,
                login_time: d.created_at,
            };
        });
    }, [data]);
    const excelMappedData = React.useMemo(() => {
        return excelData?.map((d) => {
            return {
                ...d,
                username: d?.user?.username,
                ip: d?.ip,
                location:
                    d?.location?.regionName + ", " + d?.location?.countryName,
                device: d?.agent?.browser + ", " + d?.agent?.platform,
                login_time: d.created_at,
            };
        });
    }, [excelData]);
    return (
        <>
            <Card
                headerSlot={
                    <SearchBar
                        title="Login History List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={excelMappedData}
                        labels={labels}
                        reportName="login_history_report"
                        inputSearchPlaceHolder="username"
                    />
                }
            >
                <TableBlock
                    pageName="login"
                    isLoading={isLoading}
                    totalDataCount={data?.total}
                    page={page}
                    setPage={setPage}
                    pageSize={pageSize}
                    setPageSize={setPageSize}
                    dataLength={data?.data?.length}
                    labels={labels}
                >
                    <TableBody data={tableMappedData} labels={labels} />
                </TableBlock>
            </Card>
        </>
    );
};

export default Protected(LoginHistory);

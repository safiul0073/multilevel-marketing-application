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
import { getRewardUsers } from "../../hooks/queries/reports/getRewardUsers";

const labels = [
    { key: "id", label: "Id" },
    { key: "username", label: "Username" },
    { key: "name", label: "Name" },
    { key: "email", label: "Email" },
    { key: "phone", label: "Phone" },
    { key: "designation", label: "Rank Designation" },
    { key: "created_at", label: "When" },
];

const Reward = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const { data: data, isLoading } = getRewardUsers({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize,
    });

    const { data: excelData } = getRewardUsers({
        from_date: fromDate,
        to_date: toDate,
        type: 1,
        isNotPaginate: 1,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize,
    });

    const mappedObj = (d) => {
        return {
            ...d,
            username: d?.user?.username,
            name:
                d?.user?.first_name +
                " " +
                (d?.user?.last_name ? d?.user?.last_name : ""),
            email: d?.user?.email,
            phone: d?.user?.phone,
            designation: d?.name,
            amount: d?.price,
        };
    };

    const tableMappedData = React.useMemo(() => {
        return data?.data?.map((d) => {
            return mappedObj(d);
        });
    }, [data]);

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
                        title="Reward Rank List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={excelMappedData}
                        labels={labels}
                        reportName="reward_rank_report"
                        inputSearchPlaceHolder="username, reward"
                    />
                }
            >
                <TableBlock
                    pageName="reward"
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

export default Protected(Reward);

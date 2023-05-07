import moment from "moment";
import React from "react";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import SearchBar from "../../components/ui/SearchBar";
import TableBlock from "../../components/ui/TableBlock";
import TableBody from "../../components/ui/TableBody";
import { getTopSponsorExcel } from "../../hooks/queries/reports/getTopSponsorExcel";
import { getTopSponsor } from "../../hooks/queries/reports/getTopSponsor"
import { useDebounce } from "../../hooks/others/useDebounce";

const labels = [
    { key: "id", label: "Id" },
    { key: "username", label: "Username" },
    { key: "name", label: "Name" },
    { key: "email", label: "Email" },
    { key: "phone", label: "Phone" },
    { key: "amount", label: "Earned" },
];

const TopSponsor = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1)
    const [pageSize, setPageSize] = React.useState(10)

    const {data: data, isLoading} = getTopSponsor({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize
    })

    const { data: excelData } = getTopSponsorExcel({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize,
    });

    const mappedObj = (d) => {
        return {
            ...d,
            username: d?.username,
            name:
                d?.first_name +
                " " +
                (d?.last_name ? d?.last_name : ""),
            amount: d?.top_earned?.toFixed(2),
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
                        title="Top Sponsor List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={excelMappedData}
                        labels={labels}
                        reportName="top_sponsor_report"
                        inputSearchPlaceHolder="username, phone, email"
                    />
                }
            >
                <TableBlock
                    pageName="top sponsor"
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

export default Protected(TopSponsor);

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
import { getPurchaseList } from "../../hooks/queries/reports/getPurchaseList";
import { getPurchaseListExcel } from "../../hooks/queries/reports/getPurchaseListExcel";

const labels = [
    { key: "username", label: "Username" },
    { key: "name", label: "Name" },
    { key: "category", label: "Category" },
    { key: "package_name", label: "Package" },
    { key: "amount", label: "Amount" },
    { key: "created_at", label: "When" },
];

const PackagePurchase = () => {
    const [fromDate, setFromDate] = React.useState(null);
    const [toDate, setToDate] = React.useState(null);
    const [searchKeyword, setSearchKeyword] = React.useState(null);
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const { data: data, isLoading } = getPurchaseList({
        from_date: fromDate,
        to_date: toDate,
        type: 1,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize,
    });

    const { data: excelData } = getPurchaseListExcel({
        from_date: fromDate,
        to_date: toDate,
        type: 1,
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
            category: d?.product?.category?.title,
            package_name: d?.product?.name,
            amount: d?.amount,
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
                        title="Package Purchase List"
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                        data={excelMappedData}
                        labels={labels}
                        reportName="package_purchase_report"
                        inputSearchPlaceHolder="product, category"
                    />
                }
            >
                <TableBlock
                    pageName="package"
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

export default Protected(PackagePurchase);

import moment from "moment";
import React from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import SearchBar from "../../components/ui/SearchBar";
import { useDebounce } from "../../hooks/others/useDebounce";
import { getDailyIncentive } from "../../hooks/queries/reports/getDailyIncentive";

const DailyIncentive = () => {
    const [fromDate, setFromDate] = React.useState(null)
    const [toDate, setToDate] = React.useState(null)
    const [searchKeyword, setSearchKeyword] = React.useState(null)
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum);
        setPageSize(() => currentPageValue);
    };
    const { data: joinings, isLoading } = getDailyIncentive({
        from_date: fromDate,
        to_date: toDate,
        search: useDebounce(searchKeyword),
        page: page,
        perPage: pageSize,
    });
    return (
        <>
            <Card
                headerSlot={
                    <SearchBar
                        title="Daily Bonus List"
                        inputSearchPlaceHolder="username"
                        fromDate={fromDate}
                        toDate={toDate}
                        setFromDate={setFromDate}
                        setToDate={setToDate}
                        searchKeyword={searchKeyword}
                        setSearchKeyword={setSearchKeyword}
                    />
                }
            >
                <div className="mt-8 flex flex-col">
                    <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                            {isLoading ? (
                                <LoaderAnimation />
                            ) : (
                                <>
                                    {joinings?.data?.length ? (
                                        <>
                                            <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                                <table className="min-w-full divide-y divide-gray-300">
                                                    <thead className="bg-gray-50">
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
                                                                Who Got
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
                                                                When
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody className="divide-y divide-gray-200 bg-white">
                                                        {joinings?.data?.map(
                                                            (joining) => (
                                                                <tr
                                                                    key={Math.random()}
                                                                >
                                                                    <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                                        {
                                                                            joining?.id
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {
                                                                            joining
                                                                                ?.bonus_got
                                                                                ?.username
                                                                        }
                                                                    </td>

                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {
                                                                            joining?.amount
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        <div>
                                                                            {moment(
                                                                                joining?.created_at
                                                                            ).format(
                                                                                "MM-DD-YYYY, h:mm a"
                                                                            )}
                                                                        </div>
                                                                        <div>
                                                                            {moment(
                                                                                joining?.created_at
                                                                            ).fromNow()}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            )
                                                        )}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div className="my-4">
                                                <Pagination
                                                    total={joinings?.total}
                                                    pageSize={pageSize}
                                                    pageNumber={page}
                                                    handlePageChange={
                                                        handlePageChange
                                                    }
                                                />
                                            </div>
                                        </>
                                    ) : (
                                        <RowNotFound name="joinings" />
                                    )}
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </Card>
        </>
    );
};

export default Protected(DailyIncentive);

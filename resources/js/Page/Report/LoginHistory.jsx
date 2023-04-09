import moment from "moment";
import React from "react";
import LoaderAnimation from "../../components/common/LoaderAnimation";
import Pagination from "../../components/common/Pagination";
import RowNotFound from "../../components/common/RowNotFound";
import Protected from "../../components/HOC/Protected";
import Card from "../../components/ui/Card";
import { getLoginHistory } from "../../hooks/queries/reports/getLoginHistory";

const LoginHistory = () => {
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum);
        setPageSize(() => currentPageValue);
    };
    const { data: data, isLoading } = getLoginHistory({
        from_date: "",
        to_date: "",
        page: page,
        perPage: pageSize,
    });

    return (
        <>
            <Card>
                <div className="mt-8 flex flex-col">
                    <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            {isLoading ? (
                                <LoaderAnimation />
                            ) : (
                                <>
                                    {data?.data?.length ? (
                                        <>
                                            <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                                <table className="min-w-full divide-y divide-gray-300">
                                                    <thead className="bg-gray-50">
                                                        <tr>
                                                            <th
                                                                scope="col"
                                                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                            >
                                                                Username
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                IP
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                Location
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                Device | OS
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                            >
                                                                Login Time
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody className="divide-y divide-gray-200 bg-white">
                                                        {data?.data?.map(
                                                            (person) => (
                                                                <tr
                                                                    key={Math.random()}
                                                                >
                                                                    <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                                        {
                                                                            person
                                                                                ?.user
                                                                                ?.username
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {
                                                                            person?.ip
                                                                        }
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {person
                                                                            ?.location
                                                                            ?.regionName +
                                                                            ", " +
                                                                            person
                                                                                ?.location
                                                                                ?.countryName}
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        {person
                                                                            ?.agent
                                                                            ?.browser +
                                                                            ", " +
                                                                            person
                                                                                ?.agent
                                                                                ?.platform}
                                                                    </td>
                                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                        <div className="text-left">
                                                                            <div>
                                                                                {moment(
                                                                                    person?.created_at
                                                                                ).format(
                                                                                    "MM-DD-YYYY, h:mm a"
                                                                                )}
                                                                            </div>
                                                                            <div>
                                                                                {moment(
                                                                                    person?.created_at
                                                                                ).fromNow()}
                                                                            </div>
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
                                                    total={data?.total}
                                                    pageSize={pageSize}
                                                    pageNumber={page}
                                                    handlePageChange={
                                                        handlePageChange
                                                    }
                                                />
                                            </div>
                                        </>
                                    ) : (
                                        <RowNotFound name="top earned" />
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

export default Protected(LoginHistory);

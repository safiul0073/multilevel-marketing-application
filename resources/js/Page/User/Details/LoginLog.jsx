import moment from "moment";
import React from "react";
import LoaderAnimation from "../../../components/common/LoaderAnimation";
import Pagination from "../../../components/common/Pagination";
import RowNotFound from "../../../components/common/RowNotFound";
import { loginActivity } from "../../../hooks/queries/user/loginActivity";

const LoginLog = ({ id }) => {
    const [page, setPage] = React.useState(1);
    const [pageSize, setPageSize] = React.useState(10);

    const handlePageChange = (pageNum, currentPageValue) => {
        setPage(() => pageNum);
        setPageSize(() => currentPageValue);
    };

    const { data: peoples, isLoading } = loginActivity({
        id: id,
        page: page,
        perPage: pageSize,
    });

    return (
        <div className="mt-8">
            <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div className="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
                    {isLoading ? (
                        <LoaderAnimation />
                    ) : (
                        <>
                            {peoples?.data?.length ? (
                                <>
                                    <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table className="min-w-full divide-y divide-gray-300">
                                            <thead className="bg-gray-50">
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
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
                                                {peoples?.data?.map(
                                                    (person) => (
                                                        <tr key={Math.random()}>
                                                            <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                                {person?.ip}
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
                                                                {person?.agent
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
                                            total={peoples?.total}
                                            pageSize={pageSize}
                                            pageNumber={page}
                                            handlePageChange={handlePageChange}
                                        />
                                    </div>
                                </>
                            ) : (
                                <RowNotFound name="login logs" />
                            )}
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};

export default LoginLog;

import React from "react";
const logs = [
    {
        name: "Lindsay Walton",
        userName: "lindsay-walton",
        time: "2022-10-13 12?30 PM",
        ip: "123.456.789.012",
        location: "Dhaka, Bangladesh",
        browser: "Chrome",
        os: "Windows 10",
    },
    {
        name: "Lindsay Walton",
        userName: "lindsay-walton",
        time: "2022-10-13 12?30 PM",
        ip: "123.456.789.012",
        location: "Dhaka, Bangladesh",
        browser: "Chrome",
        os: "Windows 10",
    },
    {
        name: "Lindsay Walton",
        userName: "lindsay-walton",
        time: "2022-10-13 12?30 PM",
        ip: "123.456.789.012",
        location: "Dhaka, Bangladesh",
        browser: "Chrome",
        os: "Windows 10",
    },
    {
        name: "Lindsay Walton",
        userName: "lindsay-walton",
        time: "2022-10-13 12?30 PM",
        ip: "123.456.789.012",
        location: "Dhaka, Bangladesh",
        browser: "Chrome",
        os: "Windows 10",
    },
    {
        name: "Lindsay Walton",
        userName: "lindsay-walton",
        time: "2022-10-13 12?30 PM",
        ip: "123.456.789.012",
        location: "Dhaka, Bangladesh",
        browser: "Chrome",
        os: "Windows 10",
    },
];

const LoginLog = () => {
    return (
        <div className="mt-8 flex flex-col">
            <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table className="min-w-full divide-y divide-gray-300">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        className="px-3 py-3.5 pl-4 sm:pl-6 text-left text-sm font-semibold text-gray-900"
                                    >
                                        User
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Login Time
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
                                        className="px-3 py-3.5 pr-4 sm:pr-6 text-right text-sm font-semibold text-gray-900"
                                    >
                                        Browser | OS
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 bg-white">
                                {logs.map((log) => (
                                    <tr key={Math.random()}>
                                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div className="font-medium text-gray-900">
                                                {log?.name}
                                            </div>
                                            <div className="text-gray-500">
                                                {log?.userName}
                                            </div>
                                        </td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div className="text-gray-900">
                                                {log?.time}
                                            </div>
                                            <div className="text-gray-500">
                                                2 week ago
                                            </div>
                                        </td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {log?.ip}
                                        </td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {log.location}
                                        </td>
                                        <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <div className="text-gray-900">
                                                {log?.browser}
                                            </div>
                                            <div className="text-gray-500">
                                                {log?.os}
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default LoginLog;

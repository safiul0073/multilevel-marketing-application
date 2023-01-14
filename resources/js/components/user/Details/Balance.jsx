import React from 'react'
function classNames(...classes) {
    return classes.filter(Boolean).join(" ");
}
const Balance = ({ details }) => {

    const projects = [
        {
            name: "Total Balance",
            count: details?.balance??0.00,
            suffix: "TK",
            initials: "TB",
            bgColor: "bg-indigo-700",
        },
        {
            name: "Total Withdraw",
            count: details?.total_withdraw??0.00,
            suffix: "TK",
            initials: "TW",
            bgColor: "bg-rose-600",
        },
        {
            name: "Package Purchase",
            count: details?.purchase_amount??0.00,
            suffix: "",
            initials: "PP",
            bgColor: "bg-gray-800",
        },
        {
            name: "Total Daily Commission",
            count: details?.total_today_bonus??0.00,
            suffix: "TK",
            initials: "TDC",
            bgColor: "bg-sky-500",
        },
        {
            name: "Total Referral Commission",
            count: details?.referral_bonus??0.00,
            suffix: "TK",
            initials: "TRC",
            bgColor: "bg-indigo-900",
        },
        {
            name: "Total Matching Commission",
            count: details?.matching_bonus??0.00,
            suffix: "TK",
            initials: "TMC",
            bgColor: "bg-indigo-500",
        },
        {
            name: "Total Generation Commission",
            count: details?.gen_bonus??0.00,
            suffix: "TK",
            initials: "TGC",
            bgColor: "bg-indigo-600",
        },
        {
            name: "Total Left Member",
            count: details?.left_group??0.00,
            suffix: "",
            initials: "TLM",
            bgColor: "bg-gray-800",
        },
        {
            name: "Total Right Member",
            count: details?.right_group??0.00,
            suffix: "",
            initials: "TRM",
            bgColor: "bg-violet-600",
        },
    ];
  return (
    <>
        <ul
            role="list"
            className="mt-5 grid grid-cols-1 gap-5 md:grid-cols-3 sm:gap-6"
        >
            {projects.map((project) => (
                <li
                    key={project.name}
                    className="col-span-1 flex rounded-md shadow-sm"
                >
                    <div
                        className={classNames(
                            project.bgColor,
                            "flex-shrink-0 flex bg- items-center justify-center w-16 text-white text-sm font-medium rounded-l-md"
                        )}
                    >
                        {project.initials}
                    </div>
                    <div className="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
                        <div className="flex-1 truncate px-4 py-2 text-sm text-right">
                            <h3 className="text-xl font-medium text-gray-900 hover:text-gray-600">
                                {project?.suffix
                                    ? `${project?.count} ${project?.suffix}`
                                    : project?.count}
                            </h3>
                            <p className="text-gray-500">{project.name}</p>
                        </div>
                    </div>
                </li>
            ))}
        </ul>
    </>
  )
}

export default Balance

import React from "react";

export default function UserView({ user, first }) {
    const fullName = (row) => {
        return row?.id;
        if (row?.first_name && row?.last_name) {
            return row?.first_name + " " + row?.last_name;
        } else {
            return row?.first_name;
        }
    };
    return (
        <>
            <div className="flex justify-center items-center">
                <div
                    className={`flex flex-col justify-evenly mx-5 items-center border-2 border-green-600 m-5 ${
                        !first
                            ? "relative before:absolute before:h-[20px] before:bottom-full before:w-1 before:bg-gray-400"
                            : ""
                    }`}
                >
                    <h1 className="bg-green-600 p-2 w-full">
                        {fullName(user)}
                    </h1>
                    <img
                        src="https://xsgames.co/randomusers/assets/avatars/male/24.jpg"
                        width={100}
                        height={100}
                        className=" p-3"
                        alt=""
                    />
                </div>
            </div>
        </>
    );
}

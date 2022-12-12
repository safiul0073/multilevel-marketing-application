import React from "react";

export default function UserView({ user, before }) {
    return (
        <>
            <div className="flex justify-center items-center">
                <div
                    className={`flex flex-col justify-evenly m-2 mt-3 items-center border-2 border-green-600 w-20 shrink-0 ${
                        before
                            ? "relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400"
                            : ""
                    } `}
                >
                    <h1 className="bg-green-600 p-0.5 w-full">
                        {user?.username}
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

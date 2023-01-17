import React from "react";
import { useNavigate } from "react-router-dom";

export const NewAddView = ({ referral, position }) => {
    let navigator = useNavigate();
    const newUserCreate = (referral) => {
        navigator(
            `/staff/users/registration?sponsor_id=${referral}&position=${position}`
        );
    };
    return (
        <div
            className={`flex justify-center items-start relative before:absolute before:h-1 before:top-0 before:bg-gray-400 ${
                position === "right"
                    ? "before:left-[0%] before:right-[50%]"
                    : position === "left"
                    ? "before:left-[50%] before:right-[0%]"
                    : ""
            }`}
        >
            <div
                onClick={() => newUserCreate(referral)}
                key={Math.random()}
                className="flex flex-col justify-center items-center border-2 border-green-600 mx-5 my-3 w-20 shrink-0 cursor-pointer relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400"
            >
                <h1 className="bg-green-600 p-0.5 w-full">Add new</h1>
                <img
                    src="https://cdn-icons-png.flaticon.com/512/561/561169.png"
                    width={100}
                    height={100}
                    className=" p-3"
                    alt=""
                />
            </div>
        </div>
    );
};

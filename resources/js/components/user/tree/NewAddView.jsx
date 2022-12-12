import React from "react";

export const NewAddView = ({ referral }) => {
    const newUserCreate = (referral) => {
        console.log("sponsor id: " + referral);
    };
    return (
        <div className="flex justify-center items-start basis-1/2 shrink-0">
            <div
                onClick={() => newUserCreate(referral)}
                key={Math.random()}
                className="flex flex-col justify-center items-center border-2 border-green-600 m-2 mt-3 w-20 shrink-0 cursor-pointer relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400"
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

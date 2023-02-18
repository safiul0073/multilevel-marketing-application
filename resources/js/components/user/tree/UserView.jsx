import React, { useState } from "react";
import InfoModal from "./InfoModal";

export default function UserView({ user, before }) {
    const [isOpen, setOpen] = useState(false);
    const [userId, setUserId] = useState();
    const infoView = (user) => {
        setUserId(user?.id);
        setOpen(true);
    };
    return (
        <>
            <div className="flex justify-center items-center">
                <div
                    onClick={() => infoView(user)}
                    className={`flex cursor-pointer flex-col justify-evenly mx-5 my-3 items-center border-2 border-green-600 w-20 shrink-0 ${
                        before
                            ? "relative before:absolute before:h-3.5 before:bottom-full before:w-1 before:bg-gray-400"
                            : ""
                    } `}
                >
                    <h1 className="bg-green-600 p-0.5 w-full overflow-hidden">
                        {user?.username}
                    </h1>
                    <img
                        src={
                            user?.image
                                ? user?.image?.url
                                : "https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg"
                        }
                        width={100}
                        height={100}
                        className="p-1"
                        alt=""
                    />
                </div>
            </div>
            <InfoModal isOpen={isOpen} setIsOpen={setOpen} userId={userId} />
        </>
    );
}

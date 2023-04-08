import React from "react";

const Card = ({ children, headerSlot=null }) => {
    return (
        <div className="min-h-full">
            <div className="flex flex-1 flex-col lg:pl-64">
                <main className="flex-1 py-8">
                    <div className="container">
                        {headerSlot ? headerSlot : ''}
                        {children}
                        </div>
                </main>
            </div>
        </div>
    );
};

export default Card;

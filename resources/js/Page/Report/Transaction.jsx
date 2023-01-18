import React from "react";
import Protected from "../../components/HOC/Protected";

const Transaction = () => {

    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        all Transaction report
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Transaction);

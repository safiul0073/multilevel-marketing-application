import React, { useEffect, useMemo, useState } from "react";
import Protected from "../../components/HOC/Protected";

const Incentive = () => {

    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="grid grid-cols-2 gap-3">
                                <div className="flex justify-center items-center gap-4">
                                    <label className="label-style" htmlFor="">From Date:</label>
                                    <input type="date" className="form-control" />
                                </div>
                                <div className="flex justify-center items-center gap-4">
                                    <label className="label-style"  htmlFor="">From Date:</label>
                                    <input type="date" />
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Incentive);


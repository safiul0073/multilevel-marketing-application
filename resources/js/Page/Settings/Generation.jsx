import React, { useEffect, useMemo, useState } from "react";
import Protected from "../../components/HOC/Protected";

const Generation = () => {

    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        all Generation report
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Generation);


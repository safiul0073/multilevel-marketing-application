import React from "react";
import Protected from "../../components/HOC/Protected";
import { getBonusSettings } from "../../hooks/queries/settings/getBonusSettings";
import {XMarkIcon} from "@heroicons/react/24/outline";
const Generation = () => {

    const {isLoading, data: bonus} = getBonusSettings()
    const [gen, setGen] = React.useState(bonus?.gen??[])
    React.useEffect(() => {
        setGen(bonus?.gen)
        console.log("hello")
    }, [bonus])
    const newGenAdd = () => {
        setGen([...gen, 0])
    }

    const handleChangeValue = (e, idx) => {
        setGen(() => gen.map((g, index) => {
            if (index == idx) {
                return e.target.value
            }
            return g
        }) )

    }

    const removeGen = (idx) => {
        var final_gen = []
        for (let i=0; i<gen.length; i++) {
            if (i != idx) {
                final_gen.push(gen[i])
            }
        }
        setGen(final_gen)
    }


    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="my-4 py-2 px-2 w-1/2 border border-gray-500 mx-auto">
                                <div className="flex justify-between mx-2">
                                    <p className="text-center py-4 text-gray-600 font-bold">Set Generation settings</p>
                                    <button onClick={newGenAdd} className="btn btn-primary">Add</button>
                                </div>
                                <div>
                                    {
                                        gen?.map((g, idx) => (
                                            <div key={Math.random()} className="flex justify-center items-center">
                                                <label className="block text-sm font-medium text-gray-700 w-12">Gen {idx + 1}</label>
                                                <input
                                                    type="number"
                                                    value={g}
                                                    onChange={(e) => handleChangeValue(e, idx)}
                                                    className="mt-1 block text-center rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                                                <a href="#" onClick={() => removeGen(idx)} className="text-red-600 w-10 h-10 hover:text-red-800">
                                                    <XMarkIcon/>
                                                </a>
                                            </div>
                                        ))
                                    }
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Generation);


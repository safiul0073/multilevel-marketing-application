import React from "react";
import Protected from "../../components/HOC/Protected";
import { getBonusSettings } from "../../hooks/queries/settings/getBonusSettings";
import {XMarkIcon} from "@heroicons/react/24/outline";
import { useMutation } from "react-query";
import { bonusUpdate } from "../../hooks/queries/settings";
import toast from "react-hot-toast";
import LoaderAnimation from "../../components/common/LoaderAnimation";
const Generation = () => {

    const {isLoading, data: bonus, refetch} = getBonusSettings()
    const [gen, setGen] = React.useState(bonus?.gen??[])
    React.useEffect(() => {
        setGen(bonus?.gen)
    }, [bonus])
    const newGenAdd = () => {
        setGen([...gen, 0])
    }

    const handleChangeValue = (e, idx) => {
        setGen(() => gen.map((g, index) => {
            if (index == idx) {
                return parseInt(e.target.value)
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

    const submitGenBonus = () => {
        genUpdateMutate({
            name: 'mlm_gen_bonus',
            value: gen
        })
    }

    const {
        mutate: genUpdateMutate,
        isLoading: isGenUpdateLoading
      } = useMutation(bonusUpdate, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            refetch()
        },
        onError: (err) => {
          let errorobj = err?.response?.data?.data?.json_object;
          toast.error(errorobj, {
            position: 'top-right'
          })
        },
      });

    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
                            <div className="my-4 py-2 px-2 lg:w-1/2 border border-gray-500 mx-auto">
                                <div className="flex justify-between items-center mx-2">
                                    <p className="text-center py-4 text-gray-600 font-bold">Set Generation settings</p>
                                    <button onClick={newGenAdd} className="btn btn-primary">Add</button>
                                </div>
                                <hr />
                                <div className="my-2">
                                    {
                                        isLoading ? <LoaderAnimation /> :

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

                                <div className="my-2">
                                   {isGenUpdateLoading ? (
                                        <>
                                        <button className="btn btn-primary w-full flex justify-center align-center" type="button" disabled>
                                            <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Processing ...
                                        </button>
                                        </>
                                    ) : (
                                        <button onClick={submitGenBonus} className="btn btn-primary w-full">Submit</button>
                                    )}
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


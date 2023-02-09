import React from "react";
import { useForm } from "react-hook-form";
import toast from "react-hot-toast";
import { useMutation } from "react-query";
import Protected from "../../components/HOC/Protected";
import { bonusUpdate } from "../../hooks/queries/settings";
import { getBonusSettings } from "../../hooks/queries/settings/getBonusSettings";
const Matching = () => {

    const {isLoading, data: bonus, refetch} = getBonusSettings()
    const matching_pair_types = React.useMemo(() => bonus?.matching?.pair_types, [bonus?.matching?.pair_types])
    const { register, reset, handleSubmit, formState: { errors } } = useForm()
    React.useEffect(() => {
        reset(bonus?.matching)
    }, [bonus])

    const onSubmit = (data) => {
        matchingUpdateMutate({
            name: 'mlm_matching_bonus',
            value: {...data}
        })

    }
    const {
        mutate: matchingUpdateMutate,
        isLoading: isMatchingUpdateLoading
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
                                <div className="mx-2">
                                    <p className="text-center py-4 text-gray-600 font-bold">Set Matching settings</p>
                                </div>
                                <hr />
                                <form onSubmit={handleSubmit(onSubmit)} className="px-2 my-3 ">
                                    <div className="my-2">
                                        <label className="block text-sm font-medium text-gray-700 pr-8">Matching Pair</label>
                                        <select
                                            {...register('pair_type', {required: true})}
                                            className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                        >
                                            {
                                                matching_pair_types?.map( m => (
                                                    <option key={Math.random()} value={m}>{m}</option>
                                                ))
                                            }
                                        </select>

                                    </div>
                                    <div className="my-2 ">
                                        <label className="block text-sm font-medium text-gray-700 pr-8">Pair Count</label>
                                        <input
                                            className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                            {...register('pair_value', {required: true})}
                                            type="number"
                                        />
                                    </div>
                                    <div className="my-2 ">
                                        <label className="block text-sm font-medium text-gray-700 pr-8">Pair Amount</label>
                                        <input
                                            className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                            {...register('pair_amount', {required: true})}
                                            type="number"
                                        />
                                    </div>
                                    <div className="my-2 ">
                                        <label className="block text-sm font-medium text-gray-700 pr-8">It's in Day</label>
                                        <input
                                            className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                            {...register('in_day', {required: true})}
                                            type="number"
                                        />
                                    </div>
                                    <div className="my-2 ">
                                        <label className="block text-sm font-medium text-gray-700 pr-8">It's End Time</label>
                                        <input
                                            className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                            {...register('end_time', {required: true})}
                                            type="time"
                                        />
                                    </div>
                                    {isMatchingUpdateLoading ? (
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
                                        <button type="submit" className="btn btn-primary w-full">Submit</button>
                                    )}
                                </form>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Matching);


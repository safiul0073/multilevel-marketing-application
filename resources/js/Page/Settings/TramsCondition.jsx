import React, { memo, useRef } from "react";
import Protected from "../../components/HOC/Protected";
import { getBonusSettings } from "../../hooks/queries/settings/getBonusSettings";
import { useMutation } from "react-query";
import { bonusUpdate, optionUpdate } from "../../hooks/queries/settings";
import toast from "react-hot-toast";
import { useState } from "react";
import JoditEditor from 'jodit-react';
import { getOptionValueByName } from "../../hooks/queries/settings/getOptionValueByName";
const TramsCondition = () => {

    const {isLoading, data: optionValue, refetch} = getOptionValueByName('mlm_tams_and_condition')
	const editor = useRef(null);
	const [content, setContent] = useState('');
    React.useEffect(() => {
        setContent(optionValue)
    }, [optionValue])

    const submitGenBonus = () => {
        genUpdateMutate({
            name: 'mlm_tams_and_condition',
            value: content
        })
    }

    const {
        mutate: genUpdateMutate,
        isLoading: isGenUpdateLoading
      } = useMutation(optionUpdate, {
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
                            <div className="my-4 py-2 px-2 w-full border border-gray-500 mx-auto">
                                <div className="mx-2">
                                    <p className="text-center py-4 text-gray-600 font-bold">Set Trams And Condition for your site</p>
                                </div>
                                <hr />
                                <div className="my-2">
                                    <label className="block text-sm font-medium text-gray-700 pr-8">Trams And Condition</label>
                                    <JoditEditor
                                    ref={editor}
                                    value={content}
                                    config={
                                        {
                                            readonly: false,
                                            placeholder: 'Start typings...',
                                            height: 500
                                        }
                                    }
                                    tabIndex={1} // tabIndex of textarea
                                    onBlur={newContent => setContent(newContent)} // preferred to use only this option to update the content for performance reasons
                                />
                                </div>

                                <div className="my-2">
                                   {isGenUpdateLoading? (
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
                                        <button onClick={submitGenBonus} className="btn btn-primary w-full">Save</button>
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

export default Protected(memo(TramsCondition));


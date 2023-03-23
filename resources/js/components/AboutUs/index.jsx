import React, { memo, useRef, useState } from "react";
import { useMutation } from "react-query";
import {  optionUpdate } from "../../hooks/queries/settings";
import toast from "react-hot-toast";
import JoditEditor from 'jodit-react';
import { getOptionValueByName } from "../../hooks/queries/settings/getOptionValueByName";
import ImageUpload from "../common/ImageUpload";
import { getOptionImage } from "../../hooks/queries/media/getOptionImage";
import { createMedia } from "../../hooks/queries/media";

const index = ({title, optionName, type, data, refetch}) => {

	const editor = useRef(null);
	const [content, setContent] = useState('');
    React.useEffect(() => {
        setContent(data?.content)
    }, [data])

    const submitGenBonus = () => {

        if (!content) return false

        genUpdateMutate({
            name: optionName,
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
         // gallery image handle and upload
    const uploadGalleryImage = (event) => {

        if (event.target.files[0]) {
            createMediaMutate({
                id: mediaId,
                image: event.target.files[0],
                type: optionType
            })
        }
    }
      const {
        mutate: createMediaMutate,
        isLoading,
      } = useMutation(createMedia, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            refetch()
        },
        onError: (err) => {

            let errorobj = err?.response?.data?.data?.string_data;
            toast.error(errorobj,{
                position: 'top-right'
            })
        },
      });
  return (
    <>
        <div className="my-4 py-2 px-2 border border-gray-500 mx-auto">
            <div className="flex justify-between items-center mx-2">
                <p className="text-center py-4 text-gray-600 font-bold">{title}</p>
            </div>
            <hr />
            <div className="my-2">
            <JoditEditor
                ref={editor}
                value={content}
                config={
                    {
                        readonly: false,
                        placeholder: 'Start typings...',
                        height: 300
                    }
                }
                tabIndex={1} // tabIndex of textarea
                onBlur={(newContent) => setContent(newContent)} // preferred to use only this option to update the content for performance reasons
            />
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
                    <button onClick={submitGenBonus} className="btn btn-primary w-full">Save</button>
                )}
            </div>
            {/* <div className="my-2">
                <ImageUpload
                    gallery={'Image'}
                    mediaId={data?.id}
                    optionType={type}
                />
            </div> */}
        </div>
    </>
  )
}

export default index

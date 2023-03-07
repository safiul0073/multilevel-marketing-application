import React from 'react'
import { toast } from 'react-hot-toast';
import { useMutation } from 'react-query';
import { createMedia, deleteMedia } from '../../hooks/queries/media';
import { getOptionImage } from '../../hooks/queries/media/getOptionImage';

const ImageUpload = ({gallery, mediaId, optionType}) => {
    console.log(optionType)
    const {data, refetch} = getOptionImage(mediaId, optionType)
    const deleteGellaryPhoto = (image) => {
        deleteMediaMutate(image?.id)
    };

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
        mutate: deleteMediaMutate,
        isLoading: loadingMedia,
    } = useMutation(deleteMedia, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right',
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
// create mutate
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
        <div className="mt-6 lg:grid lg:grid-cols-2 lg:gap-x-8">
        <div className="w-full">
            <div className="mb-2">
                <label
                    htmlFor="iamge"
                    className="label-style"
                >
                    {gallery}
                </label>
            </div>
            <div className="overflow-y-auto w-full overflow-x-hidden">
                <div className="grid grid-cols-2 grid-flow-row gap-2">
                    {data?.map(
                        (image) => (
                            <div
                                className=" relative"
                                key={Math.random()}
                            >
                                <div
                                    onClick={() =>
                                        deleteGellaryPhoto(
                                            image
                                        )
                                    }
                                    className="text-red-600 text-right font-extrabold absolute top-1 left-1 cursor-pointer hover:text-red-400"
                                >
                                    X
                                </div>
                                <img
                                    src={image?.url}
                                    alt={image?.url}
                                    className="object-cover object-center rounded-lg h-60"
                                />
                            </div>
                        )
                    )}
                </div>
            </div>
        </div>
        <div className="py-4">
            <div className="flex items-center justify-center w-full">
                <label
                    htmlFor="dropzone-file2"
                    className="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                >
                    <div className="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg
                            aria-hidden="true"
                            className="w-10 h-10 mb-3 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                            ></path>
                        </svg>
                        <p className="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span className="font-semibold">
                                Click to upload
                            </span>{" "}
                            or drag and drop
                        </p>
                        <p className="text-xs text-gray-500 dark:text-gray-400">
                            SVG, PNG, JPG or GIF (MAX.
                            800x400px)
                        </p>
                    </div>
                    <input
                        id="dropzone-file2"
                        type="file"
                        name="gallery"
                        className="hidden"
                        onChange={(e) =>
                            uploadGalleryImage(e)
                        }
                    />
                </label>
            </div>
        </div>
    </div>
    </>
  )
}

export default ImageUpload

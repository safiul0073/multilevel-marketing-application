import React, { useMemo } from "react";
import { ArrowLeftIcon } from "@heroicons/react/20/solid";
import toast from "react-hot-toast";
import { useMutation } from "react-query";
import { createMedia, deleteMedia } from "../../hooks/queries/media";
import { getImagesList } from "../../hooks/queries/package/getImagesList";
import { getRewardById } from "../../hooks/queries/reward/getRewardById";
import moment from "moment";

const Details = ({ showRewardDetails, setShowRewardDetails, editReward }) => {

    const { data, refetch} = getRewardById(showRewardDetails?.id)

    const deleteGellaryPhoto = (image) => {
        deleteMediaMutate(image?.id)
    };


    // gallery image handle and upload
    const uploadGalleryImage = (event) => {
        if (event.target.files[0]) {
            createMediaMutate({
                id: showRewardDetails?.id,
                image: event.target.files[0],
                type: 'reward'
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

            let errorobj = err?.response?.data?.data?.json_object;
        },
      });
    return (
        <div className="min-h-full">
            <div className="flex flex-1 flex-col lg:pl-64">
                <main className="flex-1 py-8">
                    <div className="container">
                        <div className="sm:flex sm:items-center">
                            <div className="sm:flex-auto flex items-center">
                                <button
                                    type="button"
                                    className="inline-flex items-center rounded border border-transparent bg-gray-200 p-1.5 text-black shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 mr-2"
                                    onClick={() => setShowRewardDetails(null)}
                                >
                                    <ArrowLeftIcon
                                        className="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </button>
                                <h1 className="text-xl font-semibold text-gray-900">
                                    Reward Details
                                </h1>
                            </div>
                        </div>{" "}
                        <div className="pt-6">
                            <div className="mt-6 lg:grid lg:grid-cols-2 lg:gap-x-8">
                                <div className="w-full">
                                    <div className="mb-2">
                                        <label
                                            htmlFor="iamge"
                                            className="label-style"
                                        >
                                            Gellary
                                        </label>
                                    </div>
                                    <div className="overflow-y-auto w-full overflow-x-hidden">
                                        <div className="grid grid-cols-2 grid-flow-row gap-2">
                                            {data?.images?.map(
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

                            <div className="pt-10 pb-16 lg:grid lg:grid-cols-2 lg:grid-rows-[auto,auto,1fr] lg:gap-x-0 lg:pb-24">
                                <h1 className="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                    {data?.designation}
                                </h1>

                                <div className="pb-10 lg:col-span-2 lg:col-start-1 lg:pb-16">
                                    <div className="my-4 text-left">
                                        <p className="text-lg text-gray-600">
                                            Left Count:{" "}
                                            <b>{data?.left_count}</b>
                                        </p>
                                    </div>
                                    <div className="my-4 text-left">
                                        <p className="text-lg text-gray-600">
                                            Right Count:{" "}
                                            <b>{data?.right_count}</b>
                                        </p>
                                    </div>
                                    <div className="my-4 text-left">
                                        <p className="text-lg text-gray-600">
                                            Travel Destination:{" "}
                                            <b>
                                                {
                                                    data?.travel_destination
                                                }
                                            </b>
                                        </p>
                                    </div>
                                    <div className="my-4 text-left">
                                        <p className="text-lg text-gray-600">
                                            One Time Bonus:{" "}
                                            <b>{data?.one_time_bonus}</b>
                                        </p>
                                    </div>
                                    <div className="my-4 text-left">
                                        <p className="text-lg text-gray-600">
                                            Salary: <b>{data?.salary}</b>
                                        </p>
                                    </div>
                                    <div className="my-4 text-left">
                                        <p className="text-lg text-gray-600">
                                            Created At:{" "}
                                            <b>{moment(data?.created_at).format('DD-MM-YYYY,  h:mm a')}</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    );
};

export default Details;

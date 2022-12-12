import React, { useMemo, useState } from "react";
import { ArrowLeftIcon } from "@heroicons/react/20/solid";
import  toast  from 'react-hot-toast';
import { getImagesList } from "../../hooks/queries/product/getImagesList";
import { createMedia, deleteMedia } from "../../hooks/queries/media";
import { useMutation } from "react-query";



const ProductView = ({ viewProduct, setViewProduct }) => {
    const {data: productImages, refetch} = getImagesList({
        product_id: viewProduct?.id
    })
    const thamnailImage = useMemo(() => productImages?.find((image) => (image.type == 'thamnail')), [productImages])
    const gellaryImage = useMemo(() =>{
            let images = []
            productImages?.map((image) =>
            {
                if (image.type != 'thamnail') {
                    images.push(image)
                }
            }
    ); return images}, [productImages])

    const deleteGellaryPhoto = (image) => {
        deleteMediaMutate(image?.id)
    }

    // thamnail image handle and upload
    const uploadThamnailImage = (event) => {
        if (event.target.files[0]) {
            createMediaMutate({
                id: viewProduct?.id,
                image: event.target.files[0],
                type: 'thamnail'
            })
        }
    }

    // gallery image handle and upload
    const uploadGalleryImage = (event) => {
        if (event.target.files[0]) {
            createMediaMutate({
                id: viewProduct?.id,
                image: event.target.files[0],
                type: 'gellary'
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
        <div className="bg-white">
            <div className="sm:flex sm:items-center">
                <div className="sm:flex-auto flex items-center">
                    <button
                        type="button"
                        className="inline-flex items-center rounded border border-transparent bg-gray-200 p-1.5 text-black shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 mr-2"
                        onClick={() => setViewProduct(false)}
                    >
                        <ArrowLeftIcon className="h-5 w-5" aria-hidden="true" />
                    </button>
                    <h1 className="text-xl font-semibold text-gray-900">
                        {viewProduct?.name || viewProduct?.title}
                    </h1>
                </div>
                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        type="button"
                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >
                        Edit
                    </button>
                </div>
            </div>
            <div className="pt-6">
                {/* Image gallery */}
                <div className="mt-6 lg:grid lg:grid-cols-2 lg:gap-x-8">
                    <div>
                        <label className="label-style">
                            Thumbnail
                        </label>
                        <div className="aspect-w-3 h-72 aspect-h-4 hidden overflow-hidden rounded-lg lg:block">
                            <img
                                src={thamnailImage?.url}
                                alt={thamnailImage?.url}
                                className="h-full w-full object-cover object-center rounded-lg"
                            />
                        </div>
                        <div className="py-4">
                            <input type="file" className="form-control" onChange={uploadThamnailImage} />
                        </div>
                    </div>
                    <div className="w-full h-96">
                        <div>
                            <label htmlFor="iamge" className="label-style">Gellary</label>
                        </div>
                        <div className=" h-72 overflow-y-auto w-full overflow-x-hidden">
                            <div className="grid grid-cols-2 grid-flow-row gap-2">
                            {gellaryImage?.map((image) => (
                                    <div className=" relative" key={image?.id}>
                                        <div onClick={() => deleteGellaryPhoto(image)} className="text-red-600 text-right font-extrabold absolute top-0 left-[210px] cursor-pointer hover:text-red-400">X</div>
                                        <img
                                        src={image?.url}
                                        alt={image?.url}
                                        className="object-cover object-center rounded-lg "
                                    />
                                    </div>
                                    ))}
                            </div>
                        </div>

                        <div className="py-4">
                            <input type="file" onChange={uploadGalleryImage} className="form-control" />
                        </div>
                    </div>
                </div>

                {/* Product info */}
                <div className="pt-10 pb-16 lg:grid lg:grid-cols-2 lg:grid-rows-[auto,auto,1fr] lg:gap-x-0 lg:pb-24">
                    <div className="lg:border-r lg:border-gray-200 lg:pr-4">
                        <h1 className="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            {viewProduct?.name}
                        </h1>

                        <div className="pb-10 lg:col-span-2 lg:col-start-1 lg:pb-16">
                            {/* Description and details */}
                            <div className="my-4 text-left">
                                <p className="text-lg text-gray-600">Category: {viewProduct?.category?.title}</p>
                            </div>



                            <div className="mt-10">
                                <h2 className="text-sm font-medium text-gray-600">
                                    Details / Description
                                </h2>

                                <div className="mt-4 space-y-6">
                                    <p className="text-sm text-gray-600">
                                        {viewProduct?.description}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Options */}
                    <div className="mt-4 lg:row-span-3 lg:mt-0 lg:pl-4">
                        <h2 className="sr-only">Product information</h2>
                        <p className="text-lg text-gray-600">
                            Price: {viewProduct?.price + " Taka"}
                        </p>

                        {/* Reviews */}
                        <div className="mt-6">
                            <h3 className="text-lg text-gray-600">SKU : {viewProduct?.sku} </h3>
                        </div>

                        <div className="mt-6">
                            <h3 className="text-lg text-gray-600">Referral Commission : {viewProduct?.refferral_commission + "%"} </h3>
                        </div>

                        <div className="mt-6">
                            <h1 className="text-lg text-gray-600">Video</h1>
                            <iframe className="w-full aspect-video" src={viewProduct?.video_url} frameBorder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ProductView;

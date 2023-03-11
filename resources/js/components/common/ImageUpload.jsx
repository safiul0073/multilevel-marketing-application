import React from 'react'
import { toast } from 'react-hot-toast';
import { useMutation } from 'react-query';
import { createMedia, deleteMedia } from '../../hooks/queries/media';
import { getOptionImage } from '../../hooks/queries/media/getOptionImage';
import DropZon from './DropZon';

const ImageUpload = ({gallery, mediaId, optionType}) => {

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
            <DropZon id={mediaId} type={optionType} uploadGalleryImage={uploadGalleryImage} />
        </div>
    </div>
    </>
  )
}

export default ImageUpload

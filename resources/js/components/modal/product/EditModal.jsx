import { Dialog, Transition } from "@headlessui/react";
import { yupResolver } from "@hookform/resolvers/yup";
import { Fragment, useEffect, useMemo, useState } from "react";
import { useForm } from "react-hook-form";
import { AiFillCloseCircle, AiOutlineUserAdd } from "react-icons/ai";
import { useMutation } from "react-query";
import * as yup from "yup";
import { updateProduct } from "../../../hooks/queries/product";
import { getCategorySelectlist } from "../../../hooks/queries/product/getCategorySelectlist";
import SelectInput from "../../common/SelectInput";
import Textinput from "../../common/Textinput"
import  toast  from 'react-hot-toast';

export default function EditModal({
    isOpen,
    setIsOpen,
    closeModal,
    refatcher,
    product
}) {
    const [backendError, setBackendError] = useState([])

    const {data:categories} = getCategorySelectlist()

    const schema = yup
        .object({
            name: yup.string().min(4, "Too Short!").max(500, "Too Long!").required(),
            category_id: yup.number("Select a category").required("Please select a Category!"),
            price: yup.number('Please enter package price!').required("Enter a price!"),
            refferral_commission: yup.number("Please enter referel commission!").required("Enter a price!"),
            video_url: yup.string("Video url must a link").url("Please enter a video link"),
            description: yup.string("Only string").required("Please enter package details")
        })
        .required();

    const {
        register,
        handleSubmit,
        control,
        reset,
        formState: { errors },
    } = useForm({
        resolver: yupResolver(schema),
    });
    const onSubmit = (data) => {
        let formData = {}
        formData.id = product.id
        formData.name = data.name
        formData.category_id = data.category_id
        formData.price = data.price
        formData.refferral_commission = data.refferral_commission
        formData.video_url = data.video_url.replace("watch?v=", "embed/")
        formData.description = data.description
        if (data.thamnail_image[0]) {
            formData.thamnail_image = data.thamnail_image[0]
        }
        let imagelist = []
        if (data.images[0]) {
            for (const key of Object.keys(data.images)) {
                imagelist.push(data.images[key])
              }
              formData.images = imagelist
        }
        // product update mutation calling
        updateProductMutate(formData);
    };
    function closeModal() {
        setIsOpen(false);
    }
    const {
        mutate: updateProductMutate,
        isLoading,
    } = useMutation(updateProduct, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });
            reset()
            refatcher();
            closeModal();
        },
        onError: (err) => {
            let errorobj = err?.response?.data?.data?.json_object;
            setBackendError({
                ...backendError,
                ...errorobj,
            });
        },
    });
    useEffect(() => {
        if (product) {
            reset(product)
        }
    }, [product])
    return (
        <>
            <Transition appear show={isOpen} as={Fragment}>
                <Dialog as="div" className="relative z-10" onClose={closeModal}>
                    <Transition.Child
                        as={Fragment}
                        enter="ease-out duration-300"
                        enterFrom="opacity-0"
                        enterTo="opacity-100"
                        leave="ease-in duration-200"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                    >
                        <div className="fixed inset-0 bg-black bg-opacity-25" />
                    </Transition.Child>

                    <div className="fixed inset-0 overflow-y-auto">
                        <div className="flex min-h-full items-center justify-center p-4 text-center">
                            <Transition.Child
                                as={Fragment}
                                enter="ease-out duration-300"
                                enterFrom="opacity-0 scale-95"
                                enterTo="opacity-100 scale-100"
                                leave="ease-in duration-200"
                                leaveFrom="opacity-100 scale-100"
                                leaveTo="opacity-0 scale-95"
                            >
                                <div className="inline-block w-full max-w-2xl pb-4 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-[3px]">
                                    <div className="flex items-center bg-indigo-700 text-white py-4 px-4 mb-6 font-medium text-lg text-left rounded-t-[3px]">
                                        <span className="inline-block text-2xl mr-3">
                                            <AiOutlineUserAdd />
                                        </span>
                                        Edit Product
                                    </div>

                                    <div className="px-6">
                                        <form onSubmit={handleSubmit(onSubmit)}>
                                            <div className=" w-3/4 mx-auto overflow-y-auto">
                                            <Textinput
                                                label="Package Name"
                                                placeholder="package 1"
                                                register={register}
                                                name="name"
                                                type="text"
                                                backendValidationError={backendError?.name}
                                                error={errors.name}
                                            />

                                            <SelectInput
                                                label="Select Category"
                                                labelFor="category_id"
                                                controlFu={control}
                                                reqMessage="Please select Category"
                                                optionArray={categories}
                                                errorObj={errors?.category_id}
                                                backendErrorMessagae={backendError?.category_id}
                                            />

                                            <Textinput
                                                label="Price"
                                                placeholder="5000"
                                                type="number"
                                                register={register}
                                                name="price"
                                                backendValidationError={backendError?.price}
                                                error={errors.price}
                                            />

                                            <Textinput
                                                label="Reference Commission (%)"
                                                placeholder="20"
                                                type="number"
                                                register={register}
                                                name="refferral_commission"
                                                backendValidationError={backendError?.refferral_commission}
                                                error={errors.refferral_commission}
                                            />

                                            <Textinput
                                                label="Video URL (#)"
                                                placeholder="https://www.youtube.com/watch"
                                                type="text"
                                                register={register}
                                                name="video_url"
                                                backendValidationError={backendError?.video_url}
                                                error={errors.video_url}
                                            />
                                            <Textinput
                                                label="Images (.jpg, .png, 100k - 2000k)"
                                                type="file"
                                                multiple={true}
                                                register={register}
                                                name="images"
                                                backendValidationError={backendError?.images}
                                                error={errors.images}
                                            />

                                            <Textinput
                                                label="Thamnail Image (.jpg, .png, 100k - 2000k)"
                                                type="file"
                                                register={register}
                                                name="thamnail_image"
                                                backendValidationError={backendError?.thamnail_image}
                                                error={errors.thamnail_image}
                                            />
                                            <div className="formGroup">
                                                <label htmlFor="description" className="label-style">Description</label>
                                                <textarea
                                                className="w-full my-1 rounded-md outline-none px-4 text-gray-700 hover:border-[1px] hover:border-indigo-700"
                                                {...register('description', { required: true })}
                                                placeholder="Write package details here..."
                                                id="description"
                                                cols="30"
                                                rows="5"></textarea>
                                                {backendError && backendError?.description && (
                                                    <p className="error-message">
                                                    {backendError?.description}
                                                    </p>
                                                )}
                                                {
                                                    errors && errors?.description && <div className="error-message"> {errors?.description?.message}</div>
                                                }
                                            </div>


                                                <div className="flex justify-end mt-4">
                                                    <div className="mr-3">
                                                        {isLoading ? (
                                                            <>
                                                                <button
                                                                    className="btn btn-primary flex justify-center align-center"
                                                                    type="button"
                                                                    disabled
                                                                >
                                                                    <svg
                                                                        className="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none"
                                                                        viewBox="0 0 24 24"
                                                                    >
                                                                        <circle
                                                                            className="opacity-25"
                                                                            cx="12"
                                                                            cy="12"
                                                                            r="10"
                                                                            stroke="currentColor"
                                                                            strokeWidth="4"
                                                                        ></circle>
                                                                        <path
                                                                            className="opacity-75"
                                                                            fill="currentColor"
                                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                                                        ></path>
                                                                    </svg>
                                                                    Processing
                                                                    ...
                                                                </button>
                                                            </>
                                                        ) : (
                                                            <input
                                                                type="submit"
                                                                value="Edit"
                                                                className=" cursor-pointer bg-indigo-700 text-white font-normal px-4 py-1 rounded-md"
                                                            />
                                                        )}
                                                    </div>
                                                    <div
                                                        onClick={closeModal}
                                                        className="bg-red-500 text-white font-normal px-4 py-1 rounded-md cursor-pointer"
                                                    >
                                                        <span className="inline-flex  items-center">
                                                            <span className="inline-flex mr-2">
                                                                <AiFillCloseCircle />
                                                            </span>
                                                            <span>Close</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </Transition.Child>
                        </div>
                    </div>
                </Dialog>
            </Transition>
        </>
    );
}

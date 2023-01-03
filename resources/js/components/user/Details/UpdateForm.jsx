import React from 'react'
import { useForm } from 'react-hook-form';
import toast from 'react-hot-toast';
import { useMutation } from 'react-query';
import { userUpdate } from '../../../hooks/queries/user';
import InputField from './InputField';

const UpdateForm = ({ details, detailsRefetch }) => {
    const [backendError, setBackendError] = React.useState()

    const { register, reset, handleSubmit, formState: { errors } } = useForm()
    const onSubmit= (data) => {
        updateUserMutate({
            ...data,
            id: details?.id
        })

    }

  const {
    mutate: updateUserMutate,
    isLoading,
  } = useMutation(userUpdate, {
    onSuccess: (data) => {
        toast.success(data, {
            position: 'top-right'
        });

        detailsRefetch()
    },
    onError: (err) => {

      let errorobj = err?.response?.data?.data?.json_object;
      setBackendError({
        ...backendError,
        ...errorobj,
      });
    },
  });

  React.useEffect(() => {
    reset({
        status: details?.status,
        email_verified: details?.email_verified_at ? '1' : '0',
        sms_verified: details?.sms_verified_at ? '1' : '0',
        isUpdated: details?.isUpdated
    })
  },[details])
  return (
    <>
        <form onSubmit={handleSubmit(onSubmit)} className="mt-10">
            <div className="shadow sm:overflow-hidden sm:rounded-md">
                <div className="space-y-6 bg-white py-6 px-4 sm:p-6">
                    <div>
                        <h3 className="text-lg font-medium leading-6 text-gray-900">
                            Personal Information
                        </h3>
                        <p className="mt-1 text-sm text-gray-500">
                            Use a permanent address where you can receive
                            mail.
                        </p>
                    </div>

                    <div className="grid grid-cols-12 gap-6">
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="First Name"
                                name="first_name"
                                value={details?.first_name}
                                />
                        </div>

                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Last Name"
                                name="last_name"
                                value={details?.last_name}
                            />
                        </div>

                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Email"
                                name="email"
                                value={details?.email}
                            />
                        </div>

                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Phone"
                                name="phone"
                                value={details?.phone}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Address"
                                name="address"
                                value={details?.address}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Profession"
                                name="profession"
                                value={details?.profession}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Gender"
                                name="gender"
                                value={details?.gender}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="NID Number"
                                name="nid_number"
                                value={details?.nid_number}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Father's Name"
                                name="father_name"
                                value={details?.father_name}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Mother's Name"
                                name="mother_name"
                                value={details?.mother_name}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Birthday"
                                name="birthday"
                                value={details?.birthday}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <label className="block text-sm font-medium text-gray-700" htmlFor="">
                                Select user update status
                            </label>
                            <select
                                {...register('isUpdated')}
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                name="isUpdated" id="">
                                    <option value="1">Confirmed</option>
                                    <option value="2">Pending</option>
                                    <option value="0">Editable</option>
                            </select>
                        </div>

                        <div className="col-span-12 md:col-span-4">
                        <label className="block text-sm font-medium text-gray-700" htmlFor="">
                                User active status
                            </label>
                            <select
                                {...register('status')}
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                 id="">
                                    <option value="1">Active</option>
                                    <option value="0">De-Active</option>
                            </select>
                        </div>

                        <div className="col-span-12 md:col-span-4">
                            <label className="block text-sm font-medium text-gray-700" htmlFor="">
                                Email verification Status
                            </label>
                            <select
                                { ...register('email_verified')}
                                // value={details?.email_verified_at ? '1' : '0'}
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    id="">
                                    <option value="1">Verified</option>
                                    <option value="0">Not Verified</option>
                            </select>
                        </div>
                        <div className="col-span-12 md:col-span-4">
                            <label className="block text-sm font-medium text-gray-700" htmlFor="">
                                SMS Verified Status
                            </label>
                            <select
                                { ...register('sms_verified')}
                                // value={details?.sms_verified_at ? '1' : '0'}
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                 id="">
                                    <option value="1">Verified</option>
                                    <option value="0">Not Verified</option>
                            </select>
                        </div>

                        <div className="col-span-12">
                            { isLoading
                                ?
                                <>
                                    <button className="btn btn-primary w-full flex justify-center align-center" type="button" disabled>
                                        <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing ...
                                    </button>
                                </>
                                :
                                <button type="submit" className="btn btn-primary w-full">Confirm</button>
                            }

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </>
  )
}

export default UpdateForm

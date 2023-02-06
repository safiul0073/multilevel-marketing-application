import React from 'react'
import { useForm } from 'react-hook-form';
import toast from 'react-hot-toast';
import { useMutation } from 'react-query';
import { updateUserStatus, userUpdate } from '../../../hooks/queries/user';
import InputField from './InputField';

const UpdateForm = ({ details, detailsRefetch }) => {
    const [backendError, setBackendError] = React.useState()
    const [isActivate, setActivate] = React.useState(false)

    const { register, reset, handleSubmit, formState: { errors } } = useForm()
    const onSubmit= (data) => {
        updateUserMutate({
            ...data,
            id: details?.id
        })
    }

    const updateStatus = () => {
        updateUserStatusMutate(details?.id)
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

  const {
    mutate: updateUserStatusMutate,
    isLoading:userStatusUpdateLoading,
  } = useMutation(updateUserStatus, {
    onSuccess: (data) => {
        toast.success(data, {
            position: 'top-right'
        });

        detailsRefetch()
    },
    onError: (err) => {

        console.log(err)
    },
  });

  React.useEffect(() => {
    reset({
        first_name: details?.first_name,
        last_name: details?.last_name,
        profession: details?.info?.profession,
        gender: details?.info?.gender,
        nid_number: details?.info?.nid_number,
        father_name: details?.info?.father_name,
        mother_name: details?.info?.mother_name,
        email: details?.email,
        phone: details?.phone,
        address: details?.info?.address,
        birthday: details?.info?.birthday,
        nominee_name: details?.nominee?.nominee_name,
        relation: details?.nominee?.relation,
        nominee_profession: details?.nominee?.nominee_profession,
        nominee_birthday: details?.nominee?.nominee_birthday,
        nominee_gender: details?.nominee?.nominee_gender,
        nominee_nid: details?.nominee?.nominee_nid,
        nominee_father: details?.nominee?.nominee_father,
        nominee_mother: details?.nominee?.nominee_mother,
        nominee_phone: details?.nominee?.nominee_phone,
        nominee_address: details?.nominee?.nominee_address,
        status: details?.status,
        email_verified: details?.email_verified_at ? '1' : '0',
        sms_verified: details?.sms_verified_at ? '1' : '0',
        isUpdated: details?.isUpdated
    })
    setActivate(details?.status ? true : false)
  },[details])
  return (
    <>
        <form onSubmit={handleSubmit(onSubmit)} className="mt-10">
            <div className="shadow sm:overflow-hidden sm:rounded-md">
                <div className="space-y-6 bg-white py-6 px-4 sm:p-6">
                    <div className="flex sm:flex-row flex-col justify-between items-center">
                        <h3 className="text-lg font-medium leading-6 text-gray-900">
                            Personal Information
                        </h3>
                        {
                            userStatusUpdateLoading
                            ?
                            <>
                                <button
                                    className={isActivate ?
                                                "btn btn-secondary flex justify-center align-center"
                                                : "btn btn-success flex justify-center align-center"}
                                    type="button" disabled
                                >
                                    <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing ...
                                </button>
                            </>
                            :
                            <div
                                onClick={updateStatus}
                                className={isActivate ? "btn btn-secondary cursor-pointer" : "btn btn-success cursor-pointer"}
                            >
                            {isActivate ? "De-Active" : "Active"}
                            </div>
                        }

                    </div>

                    <div className="grid grid-cols-12 gap-6">
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="First Name"
                                name="first_name"
                                backendError={backendError?.first_name}
                                register={register}
                            />
                        </div>

                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Last Name"
                                name="last_name"
                                backendError={backendError?.last_name}
                                register={register}
                            />
                        </div>

                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Email"
                                name="email"
                                backendError={backendError?.email}
                                register={register}
                            />
                        </div>

                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Phone"
                                name="phone"
                                backendError={backendError?.phone}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Address"
                                name="address"
                                backendError={backendError?.address}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Profession"
                                name="profession"
                                backendError={backendError?.profession}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <label className="block text-sm font-medium text-gray-700" htmlFor="">
                                Gender
                            </label>
                            <select
                                {...register('gender')}
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                 id="">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                            </select>
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="NID Number"
                                name="nid_number"
                                backendError={backendError?.nid_number}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Father's Name"
                                name="father_name"
                                backendError={backendError?.father_name}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Mother's Name"
                                name="mother_name"
                                backendError={backendError?.mother_name}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                type='date'
                                label="Birthday"
                                name="birthday"
                                backendError={backendError?.birthday}
                                register={register}
                            />
                        </div>

                        <div className="col-span-12 md:col-span-6">
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
                        <div className="col-span-12 sm:col-span-4">
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
                        <div className='col-span-12'>
                            <h3 className="text-lg font-medium leading-6 text-gray-900">
                                Nominee's Information
                            </h3>
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Full Name"
                                name="nominee_name"
                                backendError={backendError?.nominee_name}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Relation"
                                name="relation"
                                backendError={backendError?.relation}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Profession"
                                name="nominee_profession"
                                backendError={backendError?.nominee_profession}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <label className="block text-sm font-medium text-gray-700" htmlFor="">
                                Gender
                            </label>
                            <select
                                {...register('nominee_gender')}
                                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                 id="">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                            </select>
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                type='date'
                                label="Birthday"
                                name="nominee_birthday"
                                backendError={backendError?.nominee_birthday}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Father's Name"
                                name="nominee_father"
                                backendError={backendError?.nominee_father}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Mother's Name"
                                name="nominee_mother"
                                backendError={backendError?.nominee_mother}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Phone"
                                name="nominee_phone"
                                backendError={backendError?.nominee_phone}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="NID number"
                                name="nominee_nid"
                                backendError={backendError?.nominee_nid}
                                register={register}
                            />
                        </div>
                        <div className="col-span-12 sm:col-span-6">
                            <InputField
                                label="Address"
                                name="nominee_address"
                                backendError={backendError?.nominee_address}
                                register={register}
                            />
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

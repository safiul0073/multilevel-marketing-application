import React from 'react'

const InputField = ({ label, name, backendError, register }) => {
  return (
    <>
        <label
            htmlFor="last-name"
            className="block text-sm font-medium text-gray-700"
        >
            {label}
        </label>
        <input
            type="text"
            id={name}
            {...register(name)}
            autoComplete="family-name"
            className={(backendError ? "has-error" : '') + "mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"}
        />

        <span className="error-message">{backendError}</span>
    </>
  )
}

export default InputField

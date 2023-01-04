import React from 'react'

const InputField = ({ label, value, name }) => {
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
            value={ value? value : ''}
            name={name}
            id={name}
            autoComplete="family-name"
            className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
        />
    </>
  )
}

export default InputField

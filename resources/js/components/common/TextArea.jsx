import React from "react";

const TextArea = ({
    label,
    name,
    register,
    backendError,
    placeholder = "write something...",
    rows = 5,
}) => {
    return (
        <div className="col-span-12 formGroup">
            <label
                htmlFor="message"
                className="block text-sm font-medium text-gray-700"
            >
                {label}
            </label>
            <textarea
                name={name}
                id={name}
                rows={rows}
                placeholder={placeholder}
                {...register(name)}
                className="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
            ></textarea>
            {backendError ?? (
                <span className="error-message">{backendError}</span>
            )}
        </div>
    );
};

export default TextArea;

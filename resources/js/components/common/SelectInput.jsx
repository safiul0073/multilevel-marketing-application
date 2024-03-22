import React from "react";
import { Controller } from "react-hook-form";
import Select, { createFilter } from "react-select";

const CustomSelect = ({
    label,
    labelFor,
    controlFu,
    optionArray,
    classLabel,
    backendValidationError,
    error
}) => {
    return (
        <div>
            <label
                htmlFor={labelFor}
                className={`block cursor-pointer capitalize ${classLabel}`}
            >
                {label}
            </label>
            <Controller
                name={labelFor}
                control={controlFu}
                rules={{
                    required: false,
                }}
                render={({ field: { value, onChange, name, ref } }) => {
                    const currentSelection = optionArray?.find(
                        (c) => c.value === value
                    );
                    const handleSelectChange = (selectedOption) => {
                        onChange(selectedOption?.value);
                    };
                    return (
                        <Select
                            name={name}
                            options={optionArray}
                            id={label}
                            value={currentSelection}
                            onChange={handleSelectChange}
                            ref={ref}
                            filterOption={createFilter({
                                matchFrom: "start",
                                ignoreCase: true,
                                trim: true,
                            })}
                        />
                    );
                }}
            />
            {backendValidationError && (
                <p className="error-message">{backendValidationError}</p>
            )}

            {error && <div className="error-message"> {error.message}</div>}
        </div>
    );
};

export default CustomSelect;

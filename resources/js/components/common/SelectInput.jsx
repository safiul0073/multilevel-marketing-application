import React from "react";
import { Controller } from "react-hook-form";
import Select, { createFilter } from "react-select";

const CustomSelect = ({ label, control, optionArray }) => {
    return (
        <div>
            <Controller
                name={label}
                control={control}
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
        </div>
    );
};

export default CustomSelect;

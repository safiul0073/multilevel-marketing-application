import React from 'react';
import { Controller } from 'react-hook-form';
import Select from 'react-select';

const customStyles = {
  control: (base, state) => ({
    ...base,
    background: '#fff',
    height: '40px',

    // Overwrittes the different states of border
    borderColor: state.isFocused ? '#D1D5DB' : '#D1D5DB',
    // Removes weird border around container
    boxShadow: state.isFocused ? null : null,
    '&:hover': {
      // Overwrittes the different states of border
      borderColor: state.isFocused ? '#000080' : '#000080',
    },
  }),
  option: (provided, state) => ({
    ...provided,
    color: state.isSelected ? 'white' : '#111827',
    backgroundColor: state.isSelected ? '#000080' : '#fff',
    fontSize: state.selectProps.myFontSize,
  }),
};



const SelectInput = ({
  label,
  classLabel = "",
  labelFor,
  controlFu,
  req,
  reqMessage,
  optionArray,
  errorObj,
  backendErrorMessagae,
  multi = false,
}) => {

  return (
    <div>
      <label
        htmlFor={labelFor}
        className={`${classLabel} text-[14px] font-medium text-gray-700 block cursor-pointer mb-1 capitalize`}>
        {label}
      </label>
      <Controller
        name={labelFor}
        control={controlFu}
        rules={{
          required: reqMessage ? reqMessage : req,
        }}
        render={({ field: { value, onChange, name, ref } }) => {

          const currentSelection = optionArray?.find((c) => c?.value === value);
          const handleSelectChange = (
            selectedOption
          ) => {
            onChange(selectedOption?.value);
          };
          return (
            <Select
              name={name}
              options={optionArray}
              styles={customStyles}
              id={labelFor}
              isMulti={multi}
              value={currentSelection}
              onChange={handleSelectChange}
            />
          );
        }}
      />
      {/* {JSON.stringify(errorObj)} */}
      <span className='error-message'>{errorObj?.message}</span>
      {backendErrorMessagae && (
        <p className="error-message">
          {backendErrorMessagae}
        </p>
      )}
    </div>
  );
};

export default SelectInput;

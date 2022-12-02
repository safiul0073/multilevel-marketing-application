



  const Textinput = ({
    type,
    label,
    placeholder,
    classLabel = "text-sm text-gray-700 mb-1 font-medium",
    classInput = "",
    classGroup = "",
    register,
    name,
    readonly = false,
    dvalue = "",
    requ = true,
    backendValidationError,
    value,
    error, ...rest
  }) => {
    return (
      <>
        <div className={`formGroup ${classGroup}`}>
          {label && (
            <label htmlFor={name} className={`block cursor-pointer capitalize ${classLabel}`}>
              {label}
            </label>
          )}

          {
            name && (
              <input
                defaultValue={dvalue}
                type={type}
                id={name}
                {...register(name)} {...rest}
                className={`${error ? " has-error" : " "
                  } form-control  ${classInput}`}
                placeholder={placeholder}
                readOnly={readonly}
                value={value}
              />
            )
          }
          {
            !name && (

              <input
                type={type}
                className={`form-control  ${classInput}`}
                placeholder={placeholder}
                value={value}
              />
            )
          }

          {backendValidationError && (
            <p className="error-messag">
              {backendValidationError}
            </p>
          )}

          {
            error && <div className="error-message"> {error.message}</div>
          }
        </div>
      </>
    );
  };

  export default Textinput;

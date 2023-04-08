import { useEffect, useState } from "react";

export const useDebounce = (value, delay = 500) => {
    const [textValue, setTextValue] = useState(null);

    useEffect(() => {
        const timeId = setTimeout(() => {
            setTextValue(value);
        }, delay);

        return () => {
            clearTimeout(timeId);
        };
    }, [value, delay]);

    return textValue;
};

import React, { useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";

export function useQuery() {
    const { search } = useLocation();

    return React.useMemo(() => new URLSearchParams(search), [search]);
  }

export const useRedirectRoute = () => {
    let navigate = useNavigate();
    useEffect(() => {
        if (window.location.pathname == '/staff') {
            navigate('/staff/dashboard')
        }
        return () => {}
    }, [])
}

export const useDocumentTitle = (title) => {
    useEffect(() => {
        document.title = title
    }, [])
}

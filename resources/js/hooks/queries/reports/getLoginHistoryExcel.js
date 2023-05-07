import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getLoginHistoryExcel = (props) => {
    return useQuery(
        [
            "login-history-lists-excel",
            props.form_date,
            props.to_date,
            props.search,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/login-activity-excel", {
                from_date: props.from_date,
                to_date: props.to_date,
                search: props.search,
                page: props.page,
                perPage: props.perPage,
            });

            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

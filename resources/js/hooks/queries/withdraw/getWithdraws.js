import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getWithdraws = (props) => {
    return useQuery(
        [
            "withdraw-lists",
            props.form_date,
            props.to_date,
            props.status,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/withdraw", {
                from_date: props.from_date,
                to_date: props.to_date,
                status: props.status,
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

import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getCharges = (props) => {
    return useQuery(
        [
            "charges-lists",
            props.form_date,
            props.to_date,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/charges", {
                from_date: props.from_date,
                to_date: props.to_date,
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

import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getBonus = (props) => {
    return useQuery(
        [
            "all-bonus-lists",
            props.from_date,
            props.to_date,
            props.status,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/bonus", {
                from_date: props.from_date,
                to_date: props.to_date,
                bonus_type: props.status,
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

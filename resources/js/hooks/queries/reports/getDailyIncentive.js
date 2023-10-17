import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getDailyIncentive = (props) => {
    return useQuery(
        [
            "daily-incentive-lists",
            props.form_date,
            props.to_date,
            props.search,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/daily-incentive", {
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

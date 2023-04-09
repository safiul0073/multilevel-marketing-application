import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getDailyIncentiveExcel = (props) => {
    return useQuery(
        [
            "daily-incentive-lists-excel",
            props.form_date,
            props.to_date,
            props.search,
        ],
        async () => {
            let res = await getQuery("report/daily-incentive-excel", {
                from_date: props.from_date,
                to_date: props.to_date,
                search: props.search,
            });

            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

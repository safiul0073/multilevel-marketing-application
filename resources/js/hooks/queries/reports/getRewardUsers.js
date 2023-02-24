import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getRewardUsers = (props) => {
    return useQuery(
        [
            "reward-user-lists",
            props.form_date,
            props.to_date,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/rewards", {
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

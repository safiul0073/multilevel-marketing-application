import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getRewardUsers = (props) => {
    return useQuery(
        [
            "reward-user-lists",
            props.from_date,
            props.to_date,
            props.search,
            props.page,
            props.isNotPaginate,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/rewards", {
                from_date: props.from_date,
                to_date: props.to_date,
                search: props.search,
                isNotPaginate: props.isNotPaginate,
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

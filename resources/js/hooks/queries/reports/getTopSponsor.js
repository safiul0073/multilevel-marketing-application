import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getTopSponsor = (props) => {
    return useQuery(
        [
            "top-sponsor-lists",
            props.from_date,
            props.to_date,
            props.search,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/top-sponsor", {
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

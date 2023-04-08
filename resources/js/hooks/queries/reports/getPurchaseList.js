import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getPurchaseList = (props) => {
    return useQuery(
        [
            "purchase-lists",
            props.from_date,
            props.to_date,
            props.type,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/package-purchase", {
                from_date: props.from_date,
                to_date: props.to_date,
                type: props.type,
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

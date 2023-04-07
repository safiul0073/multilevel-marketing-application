import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getTransactions = (props) => {
    return useQuery(
        [
            "transaction-lists",
            props.from_date,
            props.to_date,
            props.page,
            props.perPage,
            props.type
        ],
        async () => {
            let res = await getQuery("report/transactions", {
                from_date: props.from_date,
                to_date: props.to_date,
                page: props.page,
                perPage: props.perPage,
                type: props.type
            });

            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

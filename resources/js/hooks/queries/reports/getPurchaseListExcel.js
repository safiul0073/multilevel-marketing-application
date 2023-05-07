import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getPurchaseListExcel = (props) => {
    return useQuery(
        [
            "purchase-lists-excel",
            props.from_date,
            props.to_date,
            props.type,
            props.search,
            props.page,
            props.perPage,
        ],
        async () => {
            let res = await getQuery("report/package-purchase-excel", {
                from_date: props.from_date,
                to_date: props.to_date,
                search: props.search,
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

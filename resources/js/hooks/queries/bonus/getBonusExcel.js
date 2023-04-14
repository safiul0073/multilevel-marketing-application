import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getBonusExcel = (props) => {
    return useQuery(
        [
            "all-bonus-excel-lists",
            props.from_date,
            props.to_date,
            props.search,
            props.status,
        ],
        async () => {
            let res = await getQuery("report/bonus-excel", {
                from_date: props.from_date,
                to_date: props.to_date,
                search: props.search,
                bonus_type: props.status,
            });

            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getCategorySelectList = () => {
    return useQuery(
        ["category-select-lists"],
        async () => {
            let res = await getQuery("category-list");
            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

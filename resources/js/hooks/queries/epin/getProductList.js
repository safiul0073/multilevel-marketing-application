import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getProductList = () => {
    return useQuery(
        ["package-select-lists"],
        async () => {
            let res = await getQuery("package-list");
            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

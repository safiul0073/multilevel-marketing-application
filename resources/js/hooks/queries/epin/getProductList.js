import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getProductList = () => {
    return useQuery(
        ["product-select-lists"],
        async () => {
            let res = await getQuery("product-list");
            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

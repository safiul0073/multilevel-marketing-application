import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getProductList = () => {
    return useQuery(
        ["product-lists"],
        async () => {
            let res = await getQuery("product");
            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

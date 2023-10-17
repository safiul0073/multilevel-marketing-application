import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getCategoryList = (page = 1, perPage = 10) => {
    return useQuery(
        ["category-lists", page, perPage],
        async () => {
            let res = await getQuery("category", {
                page: page,
                perPage: perPage,
            });

            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

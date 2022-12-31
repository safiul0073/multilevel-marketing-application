import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getPackageList = (page=1,perPage=10) => {
    return useQuery(
        ["package-lists", page,perPage],
        async () => {
            let res = await getQuery(`package`,{
                page:page,
                perPage:perPage
            });
            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

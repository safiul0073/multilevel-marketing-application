import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getSocialLinkList = (page = 1, perPage = 10) => {
    return useQuery(
        ["social-link-lists", page, perPage],
        async () => {
            let res = await getQuery("social-link", {
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

import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getSocialIcons = (page = 1, perPage = 10) => {
    return useQuery(
        ["social-icons-lists", page, perPage],
        async () => {
            let res = await getQuery("settings/social-icons");

            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

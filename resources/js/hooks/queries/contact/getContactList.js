import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getContactList = (page = 1, perPage = 10) => {
    return useQuery(
        ["contact-lists", page, perPage],
        async () => {
            let res = await getQuery("contact", {
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

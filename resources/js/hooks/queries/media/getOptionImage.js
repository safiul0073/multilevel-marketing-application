import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getOptionImage = (id, type) => {
    return useQuery(
        ["option-images-"+ type],
        async () => {
            let res = await getQuery(`settings/option-image/`, {id:id, type:type});
            return res;
        },
        {
            enabled: id && type ? true : false,
            refetchOnWindowFocus: false,
        }
    );
};

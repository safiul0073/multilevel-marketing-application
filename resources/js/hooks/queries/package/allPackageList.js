import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const allPackageList = () => {
    return useQuery(
        ["all-package"],
        async () => {
            let res = await getQuery(`all-package`);
            return res;
        },
        {
            refetchOnWindowFocus: false,
        }
    );
};

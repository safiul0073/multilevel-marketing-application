import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getImagesList = (props) => {
    return useQuery(
        ["product-image-lists", props.product_id],
        async () => {
            let res = await getQuery("product-images/"+props.product_id);
            return res;
        },
        {
            enabled: props.product_id ? true : false,
            refetchOnWindowFocus: false,
        }
    );
};

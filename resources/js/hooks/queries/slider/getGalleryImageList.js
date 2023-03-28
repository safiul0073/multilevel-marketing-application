import { useQuery } from "react-query";
import { getQuery } from "../getQuery";

export const getGalleryImageList = (props) => {
    return useQuery(
        ["slider-image-lists", props.slider_id],
        async () => {
            let res = await getQuery("slider/" + props.slider_id);
            return res;
        },
        {
            enabled: props.slider_id ? true : false,
            refetchOnWindowFocus: false,
        }
    );
};

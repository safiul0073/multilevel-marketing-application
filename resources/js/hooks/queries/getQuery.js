
import { userAxios } from '../../config/axios.config';
import { APIURL } from '../../constent';
export const getQuery = async (url, params=undefined) => {
    let res = await userAxios.get(`${APIURL}/staff/${url}`, params);

    return res?.data?.data?.json_object ?? res?.data?.data?.json_array;
}

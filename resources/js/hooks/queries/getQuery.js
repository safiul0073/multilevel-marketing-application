
import { userAxios } from '../../config/axios.config';
import { API_FULL_URL } from '../../constant';
export const getQuery = async (url, params) => {
    let res = await userAxios.get(`${API_FULL_URL}/${url}`, {
        params: params
    });
    return (res?.data?.data?.json_object ?? res?.data?.data?.json_array )?? res?.data?.data?.string_data ;
}

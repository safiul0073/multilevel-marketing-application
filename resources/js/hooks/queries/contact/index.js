import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const deleteContact = async (id) => {
    const res = await userAxios.delete(`${API_FULL_URL}/contact/${id}`);

    return res?.data?.data?.string_data;
};

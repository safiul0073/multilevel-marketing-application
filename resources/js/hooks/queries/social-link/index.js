import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createSocialLink = async (inputData) => {
    const res = await userAxios.post(`${API_FULL_URL}/social-link`, inputData);

    return res?.data?.data?.string_data;
};

export const updateSocialLink = async (inputData) => {
    const res = await userAxios.post(
        `${API_FULL_URL}/social-link/${inputData?.id}`,
        {
            ...inputData,
            _method: "PUT",
        }
    );

    return res?.data?.data?.string_data;
};

export const deleteSocialLink = async (id) => {
    const res = await userAxios.delete(`${API_FULL_URL}/social-link/${id}`);

    return res?.data?.data?.string_data;
};

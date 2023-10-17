import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createPackage = async (inputData) => {
    const res = await userAxios.post(`${API_FULL_URL}/package`, inputData);

    return res?.data?.data?.string_data;
};

export const updatePackage = async (inputData) => {
    const res = await userAxios.post(
        `${API_FULL_URL}/package/${inputData?.id}`,
        {
            ...inputData,
            _method: "PUT",
        }
    );

    return res?.data?.data?.string_data;
};

export const deletePackage = async (id) => {
    const res = await userAxios.delete(`${API_FULL_URL}/package/${id}`);

    return res?.data?.data?.string_data;
};

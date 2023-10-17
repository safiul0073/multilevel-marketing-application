import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createReward = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/reward`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateReward = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/reward/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteReward = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/reward/${id}`);

    return res?.data?.data?.string_data;
  };

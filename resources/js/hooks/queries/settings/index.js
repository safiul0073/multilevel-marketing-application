import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const bonusUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/settings/options`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const optionUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/settings/options`,
      inputData
    );

    return res?.data?.data?.string_data;
  };


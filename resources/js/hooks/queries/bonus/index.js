import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const incentiveSearch = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/incentive/search`,
      inputData
    );

    return res?.data?.data?.string_data ?? res?.data?.data?.json_object;
  };

  export const incentiveBonusGive = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/incentive/bonus-give`,
      inputData
    );

    return res?.data?.data?.string_data ?? res?.data?.data?.json_object;
  };


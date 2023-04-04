import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const confirmWithdraw = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/withdraw/confirm`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

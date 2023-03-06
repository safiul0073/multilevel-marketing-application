import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const bonusUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/settings/options`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const optionUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/settings/options`,
      inputData
    );

    return res?.data?.data?.string_data;
  };


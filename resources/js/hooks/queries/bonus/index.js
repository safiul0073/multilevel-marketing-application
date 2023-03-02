import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const incentiveSearch = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/incentive/search`,
      inputData
    );

    return res?.data?.data?.string_data ?? res?.data?.data?.json_object;
  };

  export const incentiveBonusGive = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/incentive/bonus-give`,
      inputData
    );

    return res?.data?.data?.string_data ?? res?.data?.data?.json_object;
  };


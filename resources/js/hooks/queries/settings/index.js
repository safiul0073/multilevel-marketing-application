import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const bonusUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/settings/bonus`,
      inputData
    );

    return res?.data?.data?.string_data;
  };


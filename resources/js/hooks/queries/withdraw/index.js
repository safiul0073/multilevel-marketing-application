import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const confirmWithdraw = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/withdraw/confirm`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const createReward = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/reward`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateReward = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/reward-update/`,
        inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteReward = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/reward/${id}`);

    return res?.data?.data?.string_data;
  };

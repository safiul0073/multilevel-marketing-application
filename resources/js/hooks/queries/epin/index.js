import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createEpin = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/epin`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateEpin = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/epin-update`,
        inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteEpin = async (id) => {

    const res = await userAxios.delete(
      `${APIURL}/staff/epin/${id}`);

    return res?.data?.data?.string_data;
  };
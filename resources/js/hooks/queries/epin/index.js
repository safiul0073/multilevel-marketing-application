import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createEpinMain = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/epin`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const createEpin = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/store-epin`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateEpin = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/staff/epin/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteEpin = async (id) => {

    const res = await userAxios.delete(
      `${API_FULL_URL}/staff/epin/${id}`);

    return res?.data?.data?.string_data;
  };

  export const deleteOnlyEpin = async (id) => {

    const res = await userAxios.delete(
      `${API_FULL_URL}/staff/delete-epin/${id}`);

    return res?.data?.data?.string_data;
  };

import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const createEpinMain = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/epin`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const createEpin = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/store-epin`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateEpin = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/epin/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteEpin = async (id) => {

    const res = await userAxios.delete(
      `${APIURL}/staff/epin/${id}`);

    return res?.data?.data?.string_data;
  };

  export const deleteOnlyEpin = async (id) => {

    const res = await userAxios.delete(
      `${APIURL}/staff/delete-epin/${id}`);

    return res?.data?.data?.string_data;
  };

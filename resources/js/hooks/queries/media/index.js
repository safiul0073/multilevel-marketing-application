import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const createMedia = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/image-store`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteMedia = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/image-delete/${id}`);

    return res?.data?.data?.string_data;
  };

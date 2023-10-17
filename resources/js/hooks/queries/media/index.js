import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createMedia = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/image-store`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteMedia = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/image-delete/${id}`);

    return res?.data?.data?.string_data;
  };

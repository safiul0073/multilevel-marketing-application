import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createCategory = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/category`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateCategory = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/category/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteCategory = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/category/${id}`);

    return res?.data?.data?.string_data;
  };

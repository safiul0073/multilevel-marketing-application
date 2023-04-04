import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createBlog = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/blog`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateBlog = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/blog/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteBlog = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/blog/${id}`);

    return res?.data?.data?.string_data;
  };

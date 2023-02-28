import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createBlog = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/blog`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateBlog = async (inputData) => {
    const res = await userAxios.put(
      `${APIURL}/staff/blog-update/${inputData?.id}`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteBlog = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/blog/${id}`);

    return res?.data?.data?.string_data;
  };

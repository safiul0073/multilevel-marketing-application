import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const createCategory = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/category`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateCategory = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/category/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteCategory = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/category/${id}`);

    return res?.data?.data?.string_data;
  };

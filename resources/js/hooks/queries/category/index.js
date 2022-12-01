import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createCategory = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/category`,
      inputData
    );

    return res?.data?.data?.json_object;
  };

  export const updateCategory = async (inputData) => {
    const res = await userAxios.put(
      `${APIURL}/staff/category/${inputData?.id}`,
      inputData
    );

    return res?.data?.data?.json_object;
  };

  export const deleteCategory = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/category/${id}`);

    return res?.data?.data?.json_object;
  };

import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createCategory = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/category`,
      inputData
    );

    return res?.data?.data?.json_object;
  };

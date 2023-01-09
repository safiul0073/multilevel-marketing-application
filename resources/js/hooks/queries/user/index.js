import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const changePassword = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/user/password-reset`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const userCreate = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/user`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const userUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/user/update`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteSlider = async (id) => {
    const res = await userAxios.delete(
      `${API_URL}/staff/user/${id}`);

    return res?.data?.data?.string_data;
  };

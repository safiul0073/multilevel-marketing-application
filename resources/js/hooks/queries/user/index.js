import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const changePassword = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/user/password-reset`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const userCreate = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/user`,
      inputData
    );

    return res?.data?.data?.string_data;
  };


  export const userBalanceUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/user/balance/add-sub/${inputData.id}`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const userUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/user/info/update`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteSlider = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/user/${id}`);

    return res?.data?.data?.string_data;
  };

  export const updateUserStatus = async (id) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/user/status/update/${id}`);

    return res?.data?.data?.string_data;
  };

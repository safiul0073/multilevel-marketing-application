import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

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


  export const userBalanceUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/user/balance/add-sub/${inputData.id}`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const userUpdate = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/user/info/update`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteSlider = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/user/${id}`);

    return res?.data?.data?.string_data;
  };

  export const updateUserStatus = async (id) => {
    const res = await userAxios.post(
      `${APIURL}/staff/user/status/update/${id}`);

    return res?.data?.data?.string_data;
  };

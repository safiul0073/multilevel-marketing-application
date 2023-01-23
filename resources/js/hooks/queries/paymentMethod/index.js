import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createPaymentMethod = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/payment-method`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updatePaymentMethod = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/payment-method-update/`,
        inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deletePaymentMethod = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/payment-method/${id}`);

    return res?.data?.data?.string_data;
  };

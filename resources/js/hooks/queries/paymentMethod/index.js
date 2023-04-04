import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createPaymentMethod = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/payment-method`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updatePaymentMethod = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/payment-method/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deletePaymentMethod = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/payment-method/${id}`);

    return res?.data?.data?.string_data;
  };

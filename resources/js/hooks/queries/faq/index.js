import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createFaq = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/faq`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateFaq = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/faq/${inputData?.id}`,
        {
            _method: "PUT",
            ...inputData
        }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteFaq = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/faq/${id}`);

    return res?.data?.data?.string_data;
  };

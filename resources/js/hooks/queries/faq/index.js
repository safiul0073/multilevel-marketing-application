import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const createFaq = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/faq`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateFaq = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/faq/${inputData?.id}`,
        {
            _method: "PUT",
            ...inputData
        }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteFaq = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/faq/${id}`);

    return res?.data?.data?.string_data;
  };

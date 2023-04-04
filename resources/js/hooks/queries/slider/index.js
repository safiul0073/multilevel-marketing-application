import { userAxios } from "../../../config/axios.config";
import { API_FULL_URL } from "../../../constant";

export const createSlider = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/slider`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateSlider = async (inputData) => {
    const res = await userAxios.post(
      `${API_FULL_URL}/slider/${inputData?.id}`,
      {
        ...inputData,
        _method: "PUT"
      }
    );

    return res?.data?.data?.string_data;
  };

  export const deleteSlider = async (id) => {
    const res = await userAxios.delete(
      `${API_FULL_URL}/slider/${id}`);

    return res?.data?.data?.string_data;
  };

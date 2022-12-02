import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createSlider = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/slider`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const updateSlider = async (inputData) => {
    const res = await userAxios.post(
      `${APIURL}/staff/slider-update/`,
      inputData
    );

    return res?.data?.data?.string_data;
  };

  export const deleteSlider = async (id) => {
    const res = await userAxios.delete(
      `${APIURL}/staff/slider/${id}`);

    return res?.data?.data?.string_data;
  };

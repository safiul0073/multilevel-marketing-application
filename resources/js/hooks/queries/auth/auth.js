
import { publicAxios, userAxios } from '@/config/axios.config.js';
import { APIURL } from '../../../constent';
const URL = APIURL ?? 'https://mlmshop.zstechbd.com/api'
export const getUsers = async () => {
  const res = await userAxios.get(
    `${URL}/staff/me`
  );
  return res?.data;
};

export const loginWithPassword = async (inputData) => {
  const res = await publicAxios.post(
    `${URL}/staff/login`,
    inputData
  );

  return res?.data?.data?.json_object;
};

export const getLoggedOut = async () => {
  const res = await userAxios.post(
    `${URL}/staff/logout`
  );

  return res?.data?.data?.string_data;
};

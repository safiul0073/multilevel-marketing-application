
import { publicAxios, userAxios } from '@/config/axios.config.js';
const URL = 'http://127.0.0.1:8000/api'
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


export const EmailSender = async (inputEmail) =>{
  // console.log(inputEmail);
  const res = await publicAxios.post(
    `${URL}/staff/password/email`,
    inputEmail
  )
  return res?.json_object;
};

export const OTPSender = async (inputOtp) =>{
  const res = await publicAxios.post(
    `${URL}/staff/password/code/check`,
    inputOtp
  )
  return res?.json_object;
}

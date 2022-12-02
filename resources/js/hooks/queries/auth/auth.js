
import { publicAxios, userAxios } from '@/config/axios.config.js';
import { APIURL } from '../../../constent';
const URL = APIURL
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
  return res?.data?.data?.string_data;
};

export const OTPSender = async (inputOtp) =>{
  const res = await publicAxios.post(
    `${URL}/staff/password/code/check`,
    inputOtp
  )
  return res?.data?.data?.json_object;
}

export const resetPassword = async (inputOtp) =>{
    const res = await publicAxios.post(
      `${URL}/staff/password/reset`,
      inputOtp
    )
    return res?.data?.data?.string_data;
  }

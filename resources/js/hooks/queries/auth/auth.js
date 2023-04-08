
import { publicAxios, userAxios } from '@/config/axios.config.js';
import { API_FULL_URL } from '../../../constant';
const URL = API_FULL_URL
export const getUsers = async () => {
  const res = await userAxios.get(
    `${URL}/me`
  );
  return res?.data;
};

export const loginWithPassword = async (inputData) => {
  const res = await publicAxios.post(
    `${URL}/login`,
    inputData
  );

  return res?.data?.data?.json_object;
};

export const getLoggedOut = async () => {
  const res = await userAxios.post(
    `${URL}/logout`
  );

  return res?.data?.data?.string_data;
};


export const EmailSender = async (inputEmail) =>{
  // console.log(inputEmail);
  const res = await publicAxios.post(
    `${URL}/password/email`,
    inputEmail
  )
  return res?.data?.data?.string_data;
};

export const OTPSender = async (inputOtp) =>{
  const res = await publicAxios.post(
    `${URL}/password/code/check`,
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

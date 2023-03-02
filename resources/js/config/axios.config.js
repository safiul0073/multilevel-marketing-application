import axios from 'axios';
import Cookies from 'js-cookie';
import { APIURL, TOKEN_NAME } from '../constant';


// For common config
axios.defaults.headers.post['Content-Type'] = 'application/json';

const publicAxios = axios.create({
  baseURL: APIURL,
});

let token = Cookies.get('nToken');

const userAxioswithoutRedirect = axios.create({
  baseURL: APIURL,
  headers: {
    'Access-Control-Allow-Origin': '*',
    "Accept": "application/json, text/plain, */*",
    "Content-Type": "application/json",
    "Content-Type": "multipart/form-data",
    // 'content-type': 'application/x-www-form-urlencoded;charset=utf-8',
    Authorization: `Bearer ${token}`,
  },
});

const userAxios = axios.create({
  baseURL: APIURL,
  headers: {
    'Access-Control-Allow-Origin': '*',
    "Accept": "application/json, text/plain, */*",
    "Content-Type": "application/json",
    "Content-Type": "multipart/form-data",
    // 'content-type': 'application/x-www-form-urlencoded;charset=utf-8',
    Authorization: `Bearer ${token}`,
  },
});

userAxios.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response.status === 401) {
        Cookies.remove(TOKEN_NAME)
      window.location.href = `/staff/login`;
    }
    return Promise.reject(error);
  }
);


const updateAxiosToken = (token) => {
  if (token) {
    userAxios.defaults.headers.Authorization = `Bearer ${token}`;
    userAxioswithoutRedirect.defaults.headers.Authorization = `Bearer ${token}`;
  }
};

export { publicAxios, userAxios, updateAxiosToken, userAxioswithoutRedirect };

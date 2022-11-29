import axios from 'axios';
import Cookies from 'js-cookie';

const api = import.meta.env.VITE_PUBLIC_API_URL;

// For common config
axios.defaults.headers.post['Content-Type'] = 'application/json';

const publicAxios = axios.create({
  baseURL: api,
});

let token = Cookies.get('nToken');

const userAxioswithoutRedirect = axios.create({
  baseURL: api,
  headers: {
    "Content-Type": "multipart/form-data",
    Authorization: `Bearer ${token}`,
  },
});

const userAxios = axios.create({
  baseURL: api,
  headers: {
    "Content-Type": "multipart/form-data",
    Authorization: `Bearer ${token}`,
  },
});

userAxios.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response.status === 401) {
      Cookies.remove('nToken', {
        expires: 2,
      });
      window.location.href = `staff/login`;
    }
    return Promise.reject(error);
  }
);


const updateAxiosToken = (token) => {
  if (token) {
    userAxios.defaults.headers.Authorization = `Bearer ${token}`;
    userAxioswithoutRedirect.defaults.headers.Authorization = `Bearer ${token}`;
    console.log("success")
  }
};

export { publicAxios, userAxios, updateAxiosToken, userAxioswithoutRedirect };

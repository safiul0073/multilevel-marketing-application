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
    Authorization: `Bearer ${token}`,
  },
});

const userAxios = axios.create({
  baseURL: api,
  headers: {
    Authorization: `Bearer ${token}`,
  },
});

userAxios.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response.status === 401 && router?.pathname !== '/') {
      Cookies.remove('nToken', {
        expires: 2,
      });
      window.location.href = `staff/auth/login`;
    }
    return Promise.reject(error);
  }
);

userAxios.interceptors.response.use(
  (response) => response,
  (error) => {
    console.log(
      error?.response?.data?.data?.json_object?.account_setup === false
    );
    if (error?.response?.data?.data?.json_object?.account_setup === false) {
      window.location.href = `${process.env.NEXT_PUBLIC_APP}/auth/create-shop`;
      return;
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

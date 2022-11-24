
import Cookies from 'js-cookie';
import { LIVEURL } from '../constent';

// token setter
export const setToken = (token) => {
    console.log('hy bro set token');
    Cookies.set('nAToken', token, {
      expires: 2,
    });
  };

  // logout
  export const Logout = () => {

    Cookies.remove('nAToken', {
      expires: 2,
    });
  };

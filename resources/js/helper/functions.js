
import Cookies from 'js-cookie';
import { TOKEN_NAME } from '../constant';

// token setter
export const setToken = (token) => {
    Cookies.set(TOKEN_NAME, token, {
      expires: 2,
    });
  };

  // logout
  export const Logout = () => {

    Cookies.remove(TOKEN_NAME, {
      expires: 2,
    });
  };

import { useContext, createContext, useState, useMemo } from 'react';


const AuthContext = createContext({});

export function useAuth() {
  return useContext(AuthContext);
}

export default function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [isAuth, setIsAuth] = useState(false)

  const setAuth = (status) => {
    setIsAuth(status)
  };
  const saveUser = (info) => {
    setUser(info)
  };

  const value = useMemo(() => ({ isAuth, setAuth, user, saveUser }), []);

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

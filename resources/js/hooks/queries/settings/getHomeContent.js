import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getHomeContent = () => {
  return useQuery(
    [
      'home-content-settings'
    ],
    async () => {
      let res = await getQuery('settings/home');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

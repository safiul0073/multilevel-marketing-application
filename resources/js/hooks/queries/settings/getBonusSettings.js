import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getBonusSettings = () => {
  return useQuery(
    [
      'bonus-settings'
    ],
    async () => {
      let res = await getQuery('settings/bonus');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

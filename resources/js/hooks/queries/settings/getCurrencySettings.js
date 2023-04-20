import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getCurrencySettings = () => {
  return useQuery(
    [
      'currency-settings'
    ],
    async () => {
      let res = await getQuery('settings/currency');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getBonusSettings = () => {
  return useQuery(
    [
      'transfer-charge-settings'
    ],
    async () => {
      let res = await getQuery('settings/transfer-charge');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

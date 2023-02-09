import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getOfficeInfo = () => {
  return useQuery(
    [
      'office-info-settings'
    ],
    async () => {
      let res = await getQuery('settings/office');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

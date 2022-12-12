import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getEpinList = () => {
  return useQuery(
    [
      'epin-lists'
    ],
    async () => {
      let res = await getQuery('epin');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

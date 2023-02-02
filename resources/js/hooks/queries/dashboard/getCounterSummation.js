import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getCounterSummation = () => {
  return useQuery(
    [
      'epin-main-one',

    ],
    async () => {
      let res = await getQuery('epin/');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

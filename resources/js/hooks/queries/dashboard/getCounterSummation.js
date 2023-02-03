import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getCounterSummation = () => {
  return useQuery(
    [
      'calculation-calculation',

    ],
    async () => {
      let res = await getQuery('dashboard/calculation');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

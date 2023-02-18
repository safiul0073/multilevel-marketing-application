import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getRewardById = (id) => {
  return useQuery(
    [
      'reward-only', id
    ],
    async () => {
      let res = await getQuery('reward/'+id);

      return res;
    },
    {
      enabled: id ? true : false,
      refetchOnWindowFocus: false,
    }
  );
};

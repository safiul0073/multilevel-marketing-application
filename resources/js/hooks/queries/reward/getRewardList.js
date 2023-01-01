import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getRewardList = (page=1,perPage=10) => {
  return useQuery(
    [
      'reward-lists', page,perPage
    ],
    async () => {
      let res = await getQuery('reward',{
        page:page,
        perPage:perPage
    });

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getAllUser = () => {
  return useQuery(
    [
      'user-lists'
    ],
    async () => {
      let res = await getQuery('user');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

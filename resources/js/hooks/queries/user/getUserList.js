import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getUserList = () => {
  return useQuery(
    [
      'user-select-lists'
    ],
    async () => {
      let res = await getQuery('user/list');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

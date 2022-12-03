import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const binaryTreeData = () => {
  return useQuery(
    [
      'binary-user-lists'
    ],
    async () => {
      let res = await getQuery('binary-user');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

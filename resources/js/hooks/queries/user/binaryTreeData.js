import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const binaryTreeData = ({username}) => {
  return useQuery(
    [
      'binary-user-lists',
      username
    ],
    async () => {
      let res = await getQuery('user/binary', {username:username} );

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

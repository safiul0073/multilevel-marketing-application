import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const loginActivity = (id) => {
  return useQuery(
    [
      'login-activity-lists'
    ],
    async () => {
      let res = await getQuery('user/login-activity/' + id);

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

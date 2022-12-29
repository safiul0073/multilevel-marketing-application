import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getOneUser = (id) => {
  return useQuery(
    [
      'get-one-user', id
    ],
    async () => {
      let res = await getQuery(`user/${id}`);

      return res;
    },
    {
      enabled: id ? true : false,
      refetchOnWindowFocus: false,
    }
  );
};

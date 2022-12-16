import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const userDetails = ({id}) => {
  return useQuery(
    [
      'user-details',
      id
    ],
    async () => {
      let res = await getQuery(`user-details/${id}`);

      return res;
    },
    {
      enabled: id ? true : false,
      refetchOnWindowFocus: false,
    }
  );
};

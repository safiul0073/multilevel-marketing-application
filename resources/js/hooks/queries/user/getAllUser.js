import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getAllUser = (props) => {
  return useQuery(
    [
      'user-lists',
        props.search
    ],
    async () => {
      let res = await getQuery('user',
      {search: props.search});

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

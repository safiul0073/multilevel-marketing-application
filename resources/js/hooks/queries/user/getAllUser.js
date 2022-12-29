import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getAllUser = (props) => {
  return useQuery(
    [
      'user-lists',
        props.search,
        props.page,
        props.perPage
    ],
    async () => {
      let res = await getQuery('user',
      {
        search: props.search,
        page:props.page,
        perPage:props.perPage
    });

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

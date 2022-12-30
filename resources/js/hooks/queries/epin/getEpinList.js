import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getEpinList = (page=1,perPage=10) => {
  return useQuery(
    [
      'epin-lists', page, perPage
    ],
    async () => {
      let res = await getQuery('epin',{
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

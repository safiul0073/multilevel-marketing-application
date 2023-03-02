import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getBlogList = (page=1,perPage=10) => {
  return useQuery(
    [
      'blog-lists', page, perPage
    ],
    async () => {
      let res = await getQuery('blog',{
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

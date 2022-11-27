import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getCategoryList = () => {
  return useQuery(
    [
      'category-lists'
    ],
    async () => {
      let res = await getQuery('category');
      
      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

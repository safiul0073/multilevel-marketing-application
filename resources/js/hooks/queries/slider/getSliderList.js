import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getSliderList = () => {
  return useQuery(
    [
      'slider-lists'
    ],
    async () => {
      let res = await getQuery('slider');

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

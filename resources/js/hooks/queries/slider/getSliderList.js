import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getSliderList = (page=1,perPage=10, isSlider=1) => {
  return useQuery(
    [
      'slider-lists', page, perPage
    ],
    async () => {
      let res = await getQuery('slider',{
        page:page,
        perPage:perPage,
        is_slider: isSlider
    });

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

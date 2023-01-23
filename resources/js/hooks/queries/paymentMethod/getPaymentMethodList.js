import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getPaymentMethodList = (page=1,perPage=10) => {
  return useQuery(
    [
      'payment-lists', page,perPage
    ],
    async () => {
      let res = await getQuery('payment-method',{
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

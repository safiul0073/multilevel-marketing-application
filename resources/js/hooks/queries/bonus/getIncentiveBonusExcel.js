import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getIncentiveBonusExcel = (props) => {
  return useQuery(
    [
      'incentive-bonus-lists-excel',
        props.from_date,
        props.to_date,
        props.search,
    ],
    async () => {
      let res = await getQuery('incentive/bonus-excel',
      {
        from_date: props.from_date,
        to_date: props.to_date,
        search: props.search,
    });

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

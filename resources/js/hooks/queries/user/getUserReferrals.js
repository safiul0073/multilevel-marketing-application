import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getUserReferrals = (id) => {
  return useQuery(
    [
      'get-user-referrals', id
    ],
    async () => {
      let res = await getQuery(`user/referral-list/${id}`);

      return res;
    },
    {
      enabled: id ? true : false,
      refetchOnWindowFocus: false,
    }
  );
};

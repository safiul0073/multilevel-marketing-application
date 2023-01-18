import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getUserReferrals = (id, page, perPage ) => {
  return useQuery(
    [
      'get-user-referrals', id, page, perPage
    ],
    async () => {
      let res = await getQuery(`user/referral-list/${id}`,{
        page: page,
        perPage: perPage
      });

      return res;
    },
    {
      enabled: id ? true : false,
      refetchOnWindowFocus: false,
    }
  );
};

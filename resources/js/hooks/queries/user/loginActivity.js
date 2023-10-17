import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const loginActivity = (props) => {
  return useQuery(
    [
      'login-activity-lists',
      props.id,
      props.page,
      props.pageSize
    ],
    async () => {
      let res = await getQuery('user/login-activity/' + props.id, {
        page: props.page,
        perPage: props.pageSize
      });

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

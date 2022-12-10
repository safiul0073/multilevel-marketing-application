import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getEpinMain = ({ epinMainId }) => {
  return useQuery(
    [
      'epin-main-one',
       epinMainId
    ],
    async () => {
      let res = await getQuery('epin/'+epinMainId);

      return res;
    },
    {
      enabled: epinMainId ? true : false,
      refetchOnWindowFocus: false,
    }
  );
};

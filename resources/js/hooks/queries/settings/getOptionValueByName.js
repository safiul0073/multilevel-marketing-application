import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getOptionValueByName = (name) => {
  return useQuery(
    [
      'option-value-settings'
    ],
    async () => {
      let res = await getQuery('settings/option', {name});

      return res;
    },
    {
      refetchOnWindowFocus: false,
    }
  );
};

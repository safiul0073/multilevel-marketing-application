import { useQuery } from 'react-query';
import { getQuery } from '../getQuery';

export const getOptionValueByName = (name, is_full_data = '') => {
  return useQuery(
    [
      'option-value-settings-' + name
    ],
    async () => {
      let res = await getQuery('settings/option', {name, is_full_data});

      return res;
    },
    {
        enabled: name ? true : false,
        refetchOnWindowFocus: false,
    }
  );
};

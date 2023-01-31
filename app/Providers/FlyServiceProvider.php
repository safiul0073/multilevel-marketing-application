<?php

namespace App\Providers;

use App\Traits\Formatter;
use Illuminate\Support\ServiceProvider;

class FlyServiceProvider extends ServiceProvider
{
    use Formatter;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            config()->set('mlm.bonus.incentive', get_option('mlm_incentive', config('mlm.bonus.incentive')));
            config()->set('mlm.bonus.matching', is_string(get_option('mlm_matching_bonus', config('mlm.bonus.matching'))) ? json_decode(get_option('mlm_matching_bonus', config('mlm.bonus.matching')), true) : get_option('mlm_matching_bonus', config('mlm.bonus.matching')));
            config()->set('mlm.bonus.gen', is_string(get_option('mlm_gen_bonus', config('mlm.bonus.gen'))) ? json_decode(get_option('mlm_gen_bonus', config('mlm.bonus.gen')), true) : get_option('mlm_gen_bonus', config('mlm.bonus.gen')));
            config()->set('mlm.balance_transfer', get_option('mlm_balance_transfer_charge', config('mlm.balance_transfer')));
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }
    }
}

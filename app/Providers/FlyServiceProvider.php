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
            config()->set('mlm.bonus.joining', get_option('mlm_joining_bonus', config('mlm.bonus.joining')));
            config()->set('mlm.bonus.matching', get_option('mlm_matching_bonus', config('mlm.bonus.matching')));
            config()->set('mlm.bonus.gen', get_option('mlm_gen_bonus', config('mlm.bonus.gen')));
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }
    }
}

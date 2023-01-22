<?php

namespace App\Console;

use App\Jobs\ClearDailyMatchingCount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Date;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $config_mlm_matching_hour =date('H', strtotime(config('mlm.bonus.matching.end_time')));
        // $config_mlm_matching_minutes =date('i', strtotime(config('mlm.bonus.matching.end_time')));
        // $config_mlm_matching_in_day = config('mlm.bonus.matching.in_day');
        $matching_settings = config('mlm.bonus.matching');
        // if ($config_mlm_matching_in_day == 1) {
            $schedule->call(function () use($matching_settings) {
                $users = User::select('id', 'left_count', 'right_count')->get();
                if ($matching_settings['pair_type'] == 'Auto') {
                    $users->map(function ($user) use($matching_settings) {
                        $lf_count = $user->left_count > $matching_settings['pair_value'] ? $user->left_count - $matching_settings['pair_value'] : $user->left_count;
                        $rt_count = $user->right_count > $matching_settings['pair_value'] ? $user->right_count - $matching_settings['pair_value'] : $user->right_count;
                        if ($lf_count > $rt_count) {
                            $user->right_count = 0;
                            $user->left_count = $lf_count;
                        } else if ($lf_count < $rt_count) {
                            $user->left_count = 0;
                            $user->right_count = $rt_count;
                        }else {
                            $user->left_count = $lf_count;
                            $user->right_count = $rt_count;
                        }
                        $user->save();
                    });
                } else if ($matching_settings['pair_type'] == 'Flash:Carry') {
                    $users->map(function ($user) use($matching_settings) {
                        $lf_count = $user->left_count > $matching_settings['pair_value'] ? $user->left_count - $matching_settings['pair_value'] : $user->left_count;
                        $rt_count = $user->right_count > $matching_settings['pair_value'] ? $user->right_count - $matching_settings['pair_value'] : $user->right_count;
                        $user->right_count = $rt_count;
                        $user->left_count = 0;
                        $user->save();
                    });
                }
            })->dailyAt(config('mlm.bonus.matching.end_time'))->timezone('Asia/Dhaka');
        // }else {
        //     $schedule->job(new ClearDailyMatchingCount)->corn("$config_mlm_matching_minutes $config_mlm_matching_hour $config_mlm_matching_in_day 1 $config_mlm_matching_in_day");
        // }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

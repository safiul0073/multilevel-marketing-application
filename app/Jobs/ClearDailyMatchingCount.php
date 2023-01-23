<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ClearDailyMatchingCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $matching_settings = config('mlm.bonus.matching');
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
                // $lf_count = $user->left_count > $matching_settings['pair_value'] ? $user->left_count - $matching_settings['pair_value'] : $user->left_count;
                $rt_count = $user->right_count > $matching_settings['pair_value'] ? $user->right_count - $matching_settings['pair_value'] : $user->right_count;
                $user->left_count = 0;
                $user->right_count = $rt_count;
                $user->save();
            });
        } else if ($matching_settings['pair_type'] == 'Carry:Flash') {
            $users->map(function ($user) use($matching_settings) {
                $lf_count = $user->left_count > $matching_settings['pair_value'] ? $user->left_count - $matching_settings['pair_value'] : $user->left_count;
                // $rt_count = $user->right_count > $matching_settings['pair_value'] ? $user->right_count - $matching_settings['pair_value'] : $user->right_count;
                $user->left_count = $lf_count;
                $user->right_count = 0;
                $user->save();
            });
        } else if ($matching_settings['pair_type'] == 'Carry:Carry') {
            $users->map(function ($user) use($matching_settings) {
                $lf_count = $user->left_count > $matching_settings['pair_value'] ? $user->left_count - $matching_settings['pair_value'] : $user->left_count;
                $rt_count = $user->right_count > $matching_settings['pair_value'] ? $user->right_count - $matching_settings['pair_value'] : $user->right_count;
                $user->left_count = $lf_count;
                $user->right_count = $rt_count;
                $user->save();
            });
        } else if ($matching_settings['pair_type'] == 'Flash:Flash') {
            $users->map(function ($user) use($matching_settings) {
                $user->left_count = 0;
                $user->right_count = 0;
                $user->save();
            });
        }

    }
}

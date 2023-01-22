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

    public $matching_settings;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->matching_settings = config('mlm.bonus.matching');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $users = User::select('id', 'left_count', 'right_count')->get();
        if ($this->matching_settings['pair_type'] == 'Auto') {
            $users->map(function ($user) {
                $lf_count = $user->left_count > $this->matching_settings['pair_count'] ? $user->left_count - $this->matching_settings['pair_count'] : $user->left_count;
                $rt_count = $user->right_count > $this->matching_settings['pair_count'] ? $user->right_count - $this->matching_settings['pair_count'] : $user->right_count;
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
        } else if ($this->matching_settings['pair_type'] == 'Flash:Carry') {
            $users->map(function ($user) {
                $lf_count = $user->left_count > $this->matching_settings['pair_count'] ? $user->left_count - $this->matching_settings['pair_count'] : $user->left_count;
                $rt_count = $user->right_count > $this->matching_settings['pair_count'] ? $user->right_count - $this->matching_settings['pair_count'] : $user->right_count;
                $user->right_count = $rt_count;
                $user->left_count = 0;
                $user->save();
            });
        }

    }
}

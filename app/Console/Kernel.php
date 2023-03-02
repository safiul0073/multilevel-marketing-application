<?php

namespace App\Console;

use App\Jobs\ClearDailyMatchingCount;
use App\Models\TaskScheduler;
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


        $task = TaskScheduler::where('title', 'matching')->first();
        $matching_date = new Carbon(config('mlm.bonus.matching.end_time'));

        $schedule->job(new ClearDailyMatchingCount)->dailyAt(config('mlm.bonus.matching.end_time'))->when(function () use ($task, $matching_date) {
            return (
                (new Carbon($task->date_time)) == $matching_date
            );
        })->onSuccess(function () use($task) {
            $next_end = new \Carbon\Carbon(config('mlm.bonus.matching.end_time'));
            $task->previous_date = $task->date_time;
            $task->date_time = $next_end->add(config('mlm.bonus.matching.in_day'), 'day');
            $task->save();
        });

        $schedule->command('backup:run')->daily();

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

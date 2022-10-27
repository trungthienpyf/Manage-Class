<?php

namespace App\Console;

use App\Models\ClassSchedule;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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

        $classes=ClassSchedule::query()->where('status',0)->get();
        foreach( $classes as $class){
         $month= date('M', strtotime($class->time_start ));
         $day=   date('d', strtotime($class->time_start.' - 3 days'));
            $schedule->command('demo:cron '.$class->id)->yearlyOn($month,$day,'00:01');
        }

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

<?php

namespace App\Console;

use App\Mail\NotificationChangeDateClass;
use App\Models\ClassSchedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

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
            $schedule->command('demo:cron'.$class->id)->yearlyOn($month,$day,'00:01');
         $students=   Student::query()->whereHas('classSchedules', function ($query) use($class) {
                $query->where('class_schedules.id', $class->id);
            })->get();
         $subject=$class->subject->name;
         $date_old=date('d-m-Y', strtotime($class->time_start));
         $date_new=date('d-m-Y', strtotime($class->time_start . ' + 7 days'));
        foreach($students as $student){
            $details=[
                'name'=>$subject,
                'old_time_start'=>$date_old,
                'time_start'=>$date_new,
            ];
            Mail::to($student->email)->send(new NotificationChangeDateClass($details));
        }

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

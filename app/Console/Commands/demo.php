<?php

namespace App\Console\Commands;

use App\Models\ClassSchedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class demo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $class_id = $this->argument('class');
        $class=ClassSchedule::query()->find($class_id);
        if($class->students->count()>=15){
           $date_start= date("Y-m-d H:i:s", strtotime($class->time_start. ' + 7 days' ));
           $date_end= date("Y-m-d H:i:s", strtotime($class->time_end. ' + 7 days' ));
            $class->status=1;
            $class->time_start=$date_start;
            $class->time_end=$date_end;
            $class->save();
        }


        $this->info('Demo:Cron Command Run successfully!');

    }
}

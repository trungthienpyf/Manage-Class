<?php

namespace App\Http\Controllers;



use App\Models\ClassSchedule;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function getSchedule()
    {
     $q= ClassSchedule::query()
         ->select('time_start as start','time_end as end')
         ->whereHas('students',function($query){
             $query->where('id',16);
         })

         ->where('class_schedules.id',1)
        ->first();

       return $this->weekDaysBetween([1,2],date('d-m-Y', strtotime($q->start)),date('d-m-Y', strtotime($q->end)));
    }
    function weekDaysBetween($requiredDays, $start, $end)
    {

        $startTime = Carbon::createFromFormat('d-m-Y', $start);
        $endTime = Carbon::createFromFormat('d-m-Y', $end);

        $result = [];

        while ($startTime->lt($endTime)) {

            if(in_array($startTime->dayOfWeek, $requiredDays)){
                $result[] =  Carbon::parse($startTime->copy())->toDateTimeString();
            }

            $startTime->addDay();
        }

        return $result;
    }
}

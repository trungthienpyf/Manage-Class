<?php

namespace App\Http\Controllers;


use App\Enums\WeekdaysClassEnum;
use App\Models\ClassSchedule;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSchedule()
    {
        $q = ClassSchedule::query()
            ->select('time_start as start', 'time_end as end','weekdays')
            ->whereHas('students', function ($query) {
                $query->where('id', 1);
            })
            ->where('class_schedules.id', 1)
            ->first();

        return $this->weekDaysBetween(WeekdaysClassEnum::getWeekdays($q->weekdays), date('d-m-Y', strtotime($q->start)), date('d-m-Y', strtotime($q->end)));
    }

    function weekDaysBetween($requiredDays, $start, $end)
    {

        $startTime = Carbon::createFromFormat('d-m-Y', $start);
        $endTime = Carbon::createFromFormat('d-m-Y', $end);

        $result = [];
        $i=0;
        while ($startTime->lt($endTime)) {

            if (in_array($startTime->dayOfWeek, $requiredDays)) {
                $result[$i]['start'] = Carbon::parse($startTime->copy())->toDateTimeString();
                $result[$i]['end'] = Carbon::parse($startTime->copy()->addHours(4))->toDateTimeString();

            }

            $startTime->addDay();
            $i++;
        }

        return array_values($result);
    }
    public function getWeekdays(Request $request){
        $weekdays=WeekdaysClassEnum::getViewArray();
            if($request->id==3){

                $weekdays=  array_slice($weekdays, -2);

                return response()->json($weekdays);
            }

        return response()->json($weekdays);
    }
    public function getTeachers(Request $request){
        $teachers= Teacher::query()
            ->whereDoesntHave('classSchedules',function ($query,$request){
                $query->where('shift',$request->shift);
                $query->where('weekdays',$request->weekdays);
            })->get();
        return response()->json($teachers);
    }
}

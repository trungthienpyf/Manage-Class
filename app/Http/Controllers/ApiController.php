<?php

namespace App\Http\Controllers;


use App\Enums\WeekdaysClassEnum;
use App\Models\ClassSchedule;
use Carbon\Carbon;

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
}

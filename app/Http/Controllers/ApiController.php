<?php

namespace App\Http\Controllers;


use App\Enums\WeekdaysClassEnum;
use App\Models\ClassSchedule;
use App\Models\Room;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSchedule()
    {
        $q = ClassSchedule::query()
            ->select('time_start as start', 'time_end as end', 'weekdays')
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
        $i = 0;
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

    public function getWeekdays(Request $request)
    {
        $weekdays = WeekdaysClassEnum::getViewArray();
        if ($request->id == 3) {

            $weekdays = array_slice($weekdays, -2);

            return response()->json($weekdays);
        }

        return response()->json($weekdays);
    }

    public function getRooms(Request $request)
    {
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $shift = $request->shift;
        $weekdays = $request->weekdays;
        $model=Room::query();

       $room= $this->exceptObject($model,$weekdays, $shift, $time_start, $time_end);

        return response()->json($room);
    }
    public function exceptObject($model,$weekdays, $shift, $time_start, $time_end)
    {

        return $model

            ->whereDoesntHave('classSchedules', function ($query) use ($weekdays, $shift, $time_start, $time_end) {
                $query
                    ->where('shift', $shift)
                    ->where('weekdays', $weekdays)
                    ->where(function ($query1) use ($time_start, $time_end, $weekdays, $shift) {
                        $query1->where(function ($query2) use ($time_start, $time_end, $weekdays, $shift) {
                            $query2->whereDate('time_start', '<=', $time_start)
                                ->whereDate('time_end', '>=', $time_start);
                        })
                            ->orWhere(function ($query2) use ($time_start, $time_end, $weekdays, $shift) {
                                $query2->whereDate('time_start', '<=', $time_end)
                                    ->whereDate('time_end', '>=', $time_end);

                            });
                    });
            })->get();
    }
    public function getTeachers(Request $request)
    {
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $shift = $request->shift;
        $weekdays = $request->weekdays;
        $model = Teacher::query();
        $teachers= $this->exceptObject($model,$weekdays, $shift, $time_start, $time_end);
        return response()->json($teachers);
    }
}

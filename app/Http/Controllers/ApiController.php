<?php

namespace App\Http\Controllers;


use App\Enums\WeekdaysClassEnum;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\ClassSchedule;
use App\Models\ClassStudent;
use App\Models\Room;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSchedule()
    {
        $q = ClassSchedule::query()
            //->select('time_start as start', 'time_end as end', 'weekdays')

            ->with('subject:id,name')
            ->whereHas('students', function ($query) {
                $query->where('id', 1);
            })
            ->where('class_schedules.id', 1)
            ->first(['time_start', 'time_end', 'weekdays', 'subject_id']);

        return $q;
        // return $this->weekDaysBetween(WeekdaysClassEnum::getWeekdays($q->weekdays), date('d-m-Y', strtotime($q->start)), date('d-m-Y', strtotime($q->end)));
    }

    public function getScheduleTeacher(Request $request)
    {

        $q = ClassSchedule::query()
            ->with('subject')
            ->with('room')
            ->whereHas('teacher', function ($query) {
                $query->where('id', 2);
            })
            ->first(['time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id']);


        return $this->weekDaysBetween(WeekdaysClassEnum::getWeekdays($q->weekdays), date('d-m-Y', strtotime($q->start)), date('d-m-Y', strtotime($q->end)), $q->subject->name . " - " . $q->room->name);
    }

    public function getDateAttendance(Request $request)
    {

        $q = ClassSchedule::query()
            ->with('attendances')
            ->where('id', $request->id)
            ->first(['time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id', 'id']);

        $array = $this->weekDaysBetween(WeekdaysClassEnum::getWeekdays($q->weekdays), date('d-m-Y', strtotime($q->start)), date('d-m-Y', strtotime($q->end)));
        $arr = [];
        $i = 0;
        foreach ($array as $date) {
            if (explode(" ", $date['start'])[0] <= date('Y-m-d')) {
                $i++;
                $arr[$i] = explode(" ", $date['start'])[0];
            }

        }
        $check = Attendance::query()


            ->where('classSchedule_id', $request->id)
            ->where(function($query) use ($arr){
                foreach($arr as $date){
                    $query->orWhere('date', $date);
                }
    })
                ->get(['date']);




        return [$arr, $check->all()];
    }


    function weekDaysBetween($requiredDays, $start, $end, $title = null)
    {

        $startTime = Carbon::createFromFormat('d-m-Y', $start);
        $endTime = Carbon::createFromFormat('d-m-Y', $end);

        $result = [];
        $i = 0;
        while ($startTime->lt($endTime)) {

            if (in_array($startTime->dayOfWeek, $requiredDays)) {
                $result[$i]['title'] = $title;
                $result[$i]['start'] = Carbon::parse($startTime->copy())->toDateTimeString();
                $result[$i]['end'] = Carbon::parse($startTime->copy()->addHours(4))->toDateTimeString();

                $result[$i]['title'] = $title;
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
        $model = Room::query();

        $room = $this->exceptObject($model, $weekdays, $shift, $time_start, $time_end);

        return response()->json($room);
    }

    public function exceptObject($model, $weekdays, $shift, $time_start, $time_end)
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
        $teachers = $this->exceptObject($model, $weekdays, $shift, $time_start, $time_end);
        return response()->json($teachers);
    }
}

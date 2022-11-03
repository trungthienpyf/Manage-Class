<?php

namespace App\Http\Controllers;

use App\Enums\ShiftClassEnum;
use App\Http\Controllers\ApiController;

use App\Enums\WeekdaysClassEnum;

use App\Models\ClassSchedule;

class ClassOfMineController extends Controller
{
    public function indexTeacher()
    {
        View()->share('title', 'Lớp dạy');
        $schedules = ClassSchedule::query()
            ->with('subject')
            ->where('teacher_id', Auth()->user()->id)
            ->get();
        $q = ClassSchedule::query()
            ->with('subject')
            ->with('room')
            ->whereHas('teacher', function ($query) {
                $query->where('id', Auth()->user()->id);
            })
            ->get(['id','shift','time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id']);
        $arr = [];
        foreach ($q as $item) {
            $schedule=  (new ApiController)->getNextweekDays(WeekdaysClassEnum::getWeekdays($item->weekdays),
                date('d-m-Y', strtotime($item->start)), date('d-m-Y', strtotime($item->end)),
                ShiftClassEnum::getShift($item->shift),
            );
            $arr[$item->id] = $schedule;

        }


        return view('teacher.class_teacher', [
            'schedules' => $schedules,
            'dateCloset'    => $arr,
        ]);
    }
    public function indexStudent()
    {
        View()->share('title', 'Lớp học');
        $schedules = ClassSchedule::query()
            ->with('subject')
            ->with('attendances.AttendanceStudents')
            ->whereHas('students', function ($query)  {
                $query->where('id', auth()->user()->id);
            })

            ->get();

        $q = ClassSchedule::query()
            ->with('subject:id,name as title')
            ->with('room')
            ->whereHas('students', function ($query)  {
                $query->where('id',  auth()->user()->id);
            })
            ->get(['id','shift', 'time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id']);

        $arr = [];
        foreach ($q as $item) {
            $schedule=  (new ApiController)->getNextweekDays(WeekdaysClassEnum::getWeekdays($item->weekdays),
                date('d-m-Y', strtotime($item->start)), date('d-m-Y', strtotime($item->end)),
                ShiftClassEnum::getShift($item->shift),
            );
            $arr[$item->id] = $schedule;

        }


        return view('student.class_student', [
            'schedules' => $schedules,
            'dateCloset'    => $arr,
        ]);
    }
}

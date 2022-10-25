<?php

namespace App\Http\Controllers;



use App\Enums\WeekdaysClassEnum;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){


        $q = Attendance::query()

            ->whereHas('AttendanceStudents', function ($query) {
                $query->where('attendance_students.student_id', 1)
                   ->where('attendance_students.status', 1);

            })
            ->get()
            ->map(function ($item) {
                $arr[$item->classSchedule_id] =date("Y-m-d", strtotime($item->date));

              return    $arr;

            })->toArray();
        $q2 = Attendance::query()

            ->whereHas('AttendanceStudents', function ($query) {
                $query->where('attendance_students.student_id', 1)
                   ->where('attendance_students.status', 2);

            })

            ->get()
            ->map(function ($item) {
                $arr[$item->classSchedule_id] =date("Y-m-d", strtotime($item->date));
                $arr['status'] =2;
              return    $arr;

            })->toArray();

        return $q;
        // return view('index');

    }
}

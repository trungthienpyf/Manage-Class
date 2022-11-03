<?php

namespace App\Http\Controllers;


use App\Enums\ShiftClassEnum;
use App\Enums\TimeLineEnum;
use App\Enums\WeekdaysClassEnum;
use App\Mail\NotificationChangeDateClass;
use App\Mail\RegisterClass;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function test()
    {

        $q = ClassSchedule::query()
            ->with('subject')
            ->with('room')
            ->whereHas('teacher', function ($query) {
                $query->where('id', 2);
            })
            ->get(['id','time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id']);
        return $q;
    }
}

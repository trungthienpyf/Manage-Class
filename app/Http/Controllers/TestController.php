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


        $classes=ClassSchedule::query()->where('status',0)->first();
        $subject=$classes->subject->name;
        return $subject;
    }
}

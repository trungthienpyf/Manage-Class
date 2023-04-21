<?php

namespace App\Http\Controllers;


use App\Enums\ShiftClassEnum;
use App\Enums\TimeLineEnum;
use App\Enums\WeekdaysClassEnum;
use App\Mail\NotificationChangeDateClass;
use App\Mail\RegisterClass;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use App\Models\RegisterTeach;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
//    public function test()
//    {
//return RegisterTeach::query()
//    ->where('weekdays', 1)
//    ->where('shift', 1)
//    ->get();
//
//
//    }
public function test(){
    dd(auth()->user()->id);
}
}

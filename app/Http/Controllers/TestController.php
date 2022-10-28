<?php

namespace App\Http\Controllers;



use App\Enums\ShiftClassEnum;
use App\Enums\TimeLineEnum;
use App\Enums\WeekdaysClassEnum;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){


        $name = 1;
        $email = 1;
        $phone = 1;
        $password = 1;
        $subjectName = 'Audreanne Kuhlman';
        $shift = 'Sáng';
        $weekdays = 'Thứ 2-5';
        $time_line = '2 Tuần';
        $student= Student::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
        ]);
        $subject= Subject::query()->where('name',$subjectName)->first();
        if($subject==null){
            return 0;

        }
        $classSchedule = ClassSchedule::query()->where('subject_id',$subject->id)
            ->where('status',0)
            ->where('shift',ShiftClassEnum::getShiftEnum($shift))
            ->where('weekdays',WeekdaysClassEnum::getValueWeekdaysEnum($weekdays))
            ->where('time_line',TimeLineEnum::getValueTimeLineEnum($time_line))
            ->first();
        if($classSchedule==null){
            return 0;
        }
        $classSchedule->students()->attach($student->id);


       return 1;
        // return view('index');

    }
}

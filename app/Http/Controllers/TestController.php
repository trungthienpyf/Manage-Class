<?php

namespace App\Http\Controllers;



use App\Enums\WeekdaysClassEnum;
use App\Models\ClassSchedule;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){


        $q = ClassSchedule::query()
            ->with('attendances')
            ->where('id', 4)
            ->first(['time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id']);
           return  $q;
           // return view('index');

    }
}

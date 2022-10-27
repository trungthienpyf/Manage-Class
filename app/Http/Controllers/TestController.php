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


        $class=ClassSchedule::query()->find(6);
        //if($class->students->count()>=2){
        $date= date("Y-m-d H:i:s", strtotime($class->time_start. ' + 3 days' ));
        $class->status=1;
        $class->time_start=$date;
        $class->save();

        return $class->students->count();
        // return view('index');

    }
}

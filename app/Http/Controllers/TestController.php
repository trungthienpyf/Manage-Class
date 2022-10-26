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


        $classes= ClassSchedule::query()->with('subject')->get();

        return $classes;
        // return view('index');

    }
}

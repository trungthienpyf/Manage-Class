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
            //  ->select('time_start as start', 'time_end as end', 'weekdays')
            ->with('subject')
            ->whereHas('teacher', function ($query)  {
                $query->where('id', 2);
            })
            ->first(['time_start as start', 'time_end as end','weekdays','subject_id']);
           return  $q;
           // return view('index');

    }
}

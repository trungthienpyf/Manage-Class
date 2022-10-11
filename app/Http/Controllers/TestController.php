<?php

namespace App\Http\Controllers;



use App\Enums\WeekdaysClassEnum;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){


        $room = Room::query();
        dd($room);
//            ->whereHas('classSchedules', function ($query) {
//
//                $query->whereDate('time_start','<=',"2022-10-09")
//                    ->whereDate('time_end','>=', "2022-10-09")
//                  ->whereDate('time_start','<=',"2022-10-09")
//                      ->whereDate('time_end','>=', "2022-10-09")
//                    ->where('shift', 1)
//                ->where('weekdays', 1);
//
//            })->get();

            return view('index');

    }
}

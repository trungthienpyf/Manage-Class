<?php

namespace App\Http\Controllers;




class ScheduleTeacherController extends Controller
{
    public function index(){

    return view('teacher.calendar');
    }
}

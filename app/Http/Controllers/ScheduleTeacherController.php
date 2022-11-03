<?php

namespace App\Http\Controllers;




use Illuminate\Support\Facades\View;

class ScheduleTeacherController extends Controller
{
    public function index(){
        View::share('title', 'Lịch dạy');
    return view('teacher.calendar');
    }
}

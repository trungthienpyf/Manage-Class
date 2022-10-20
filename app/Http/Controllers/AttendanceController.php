<?php

namespace App\Http\Controllers;




use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
    $students=Student::query()
        ->with('classSchedules')
        ->whereHas('classSchedules',function ($q){
            $q->where('id',1);
        })

        ->get();
    return view('teacher.attendance',['students'=>$students]);
    }
    public function attendance(Request $request){
        dd($request->all());
       // return view('teacher.attendance',['students'=>$students]);
    }

}

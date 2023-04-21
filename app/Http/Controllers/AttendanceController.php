<?php

namespace App\Http\Controllers;


use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\ClassSchedule;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AttendanceController extends Controller
{
    public function index()
    {
        $schedules = ClassSchedule::query()
            ->with('students', 'subject')
            ->where('teacher_id', Auth()->user()->id)
            ->get();


        View::share('title', 'Điểm danh');
        return view('teacher.attendance', [
            'schedules' => $schedules,

        ]);
    }
    public function attendance_ai(Request  $request)
    {


        View::share('title', 'Điểm danh AI');
      $attendance_id  =Attendance::firstOrCreate( [
            'classSchedule_id'=>$request->id,
            'date'=>$request->date,
           'teacher_id'=> auth()->user()->id
            ])->id;


        return view('teacher.attendance_ai',[
            'class_id'=>$request->id,
            'date'=>$request->date,
            'attendance_id'=>$attendance_id,



        ]);
    }
    public function getAttendanceClass(Request $request)
    {
        $schedules = ClassSchedule::query()
            ->with('students', 'subject')
            ->where('teacher_id', Auth()->user()->id)
            ->where('id', $request->classSchedule_id)
            ->get();

        $attendanceId = Attendance::query()
            ->where('classSchedule_id', $request->classSchedule_id)
            ->where('teacher_id',  Auth()->user()->id)
            ->where('date', $request->date)
            ->value('id');
        $arr = [];

        if (!empty($attendanceId)) {
            $attendances = AttendanceStudent::query()
                ->where('attendance_id', $attendanceId)
                ->get();

            foreach ($attendances as $attendance) {

                $arr[$attendance->student_id] = $attendance->status;

            }

        }

        return [
            $schedules,
            $arr
        ];
    }

    public function attendance(Request $request)
    {

        $statuses = $request->get('status');
        $class_id = $request->get('class_id');
        $date =$request->date;
        $teacher_id = Auth()->user()->id;

        $attendance = Attendance::query()->where([
            'classSchedule_id' => $class_id,
            'teacher_id' => $teacher_id,
            'date' => $date,
        ])->first();

        if (is_null($attendance)) {
            $attendance = Attendance::create([
                'classSchedule_id' => $class_id,
                'teacher_id' => $teacher_id,
                'date' => $date,
            ]);
        }

        foreach ($statuses as $student_id => $status) {
            AttendanceStudent::updateOrInsert([
                'attendance_id' => $attendance->id,
                'student_id' => $student_id,

            ],
                [
                    'status' => $status,
                ]
            );
        }
        return response()->json(['success' => true]);
    }

}

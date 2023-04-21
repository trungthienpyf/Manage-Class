<?php

namespace App\Http\Controllers;


use App\Enums\WeekdaysClassEnum;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\ClassSchedule;
use App\Models\ClassStudent;
use App\Models\RegisterTeach;
use App\Models\Room;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getListStudentByIdClass(Request $request){
        return Student::query()->whereHas('classSchedules',function ($q) use($request){
            $q->where('id',$request->id);
        })->get();

    }
    public function AttendanceAi(Request $request){

        return Attendance::query()->where('classSchedule_id',$request->id)
            ->where('date',$request->date)
            ->whereHas('AttendanceStudents',function ($q) use($request){
                $q->where('student_id',$request->student_id);
                $q->where('attendance_id',$request->attendance_id);
                $q->where('status','=',1);
        })
            ->first();

    }
    public function CreateAttendance(Request $request){

        if(Attendance::query()->where('classSchedule_id',$request->id)->where('date',$request->date)->first()==null){

            Attendance::create([
                'classSchedule_id'=>$request->id,
                'teacher_id'=>$request->teacher_id,
                'date'=>$request->date,
            ]);
        }
    }
    public function AttendanceStudentAi(Request $request){

        $class_attend= Attendance::query()->where('classSchedule_id',$request->id)
            ->where('date',$request->date)
            ->get()
            ->first();
     $check=   AttendanceStudent::query()->where('attendance_id',$class_attend->id)->where('student_id',$request->student_id);
        if($check->get()->first()==null ){

            $attend_stu = Attendance::find($class_attend->id);

            $attend_stu->AttendanceStudents()->attach($request->student_id,[
                'status'=>1
            ]);
        }else{
           $check->update([
               'status'=>1
           ]);
        }



    }
    public function getSchedule(Request $request)
    {

        $q = ClassSchedule::query()
            ->with('subject:id,name as title')
            ->with('room')
            ->whereHas('students', function ($query) use ($request) {
                $query->where('id', $request->id);
            })
            ->get(['id', 'time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id']);

        $attendance = Attendance::query()
            ->whereHas('AttendanceStudents', function ($query) use ($request) {
                $query->where('attendance_students.student_id', $request->id)
                    ->where('attendance_students.status', 1);
            })
            ->get()
            ->map(function ($item) {
                $arr[$item->classSchedule_id] = date("Y-m-d", strtotime($item->date));

                return $arr;

            })->toArray();
        $attendanceDropOut = Attendance::query()
            ->whereHas('AttendanceStudents', function ($query) use ($request) {
                $query->where('attendance_students.student_id', $request->id)
                    ->where('attendance_students.status', 2);
            })
            ->get()
            ->map(function ($item) {
                $arr[$item->classSchedule_id] = date("Y-m-d", strtotime($item->date));

                return $arr;

            })->toArray();

        $arr = [];
        try {
            foreach ($q as $item) {
                $nameSubject = $item->subject->title;
                $nameRoom = $item->room->name;


                $schedule = $this->weekDaysBetween(WeekdaysClassEnum::getWeekdays($item->weekdays),
                    date('d-m-Y H:i:s', strtotime($item->start)), date('d-m-Y H:i:s', strtotime($item->end)),
                    $nameSubject . " - " . $nameRoom,
                    $item->id,
                    $attendance,
                    $attendanceDropOut
                );
                $arr = array_merge($arr, $schedule);
            }
        } catch (\Exception $e) {

        }


        return $arr;
    }

    public function getScheduleTeacher(Request $request)
    {

        $q = ClassSchedule::query()
            ->with('subject')
            ->with('room')
            ->whereHas('teacher', function ($query) use ($request) {
                $query->where('id', $request->id);
            })
            ->get(['time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id']);
        $arr = [];
        foreach ($q as $item) {
            $schedule = $this->weekDaysBetween(WeekdaysClassEnum::getWeekdays($item->weekdays),
                date('d-m-Y H:i:s', strtotime($item->start)), date('d-m-Y H:i:s', strtotime($item->end)), $item->subject->name . " - " . $item->room->name);
            $arr = array_merge($arr, $schedule);
        }
        return $arr;
    }

    public function getDateAttendance(Request $request)
    {

        $q = ClassSchedule::query()
            ->with('attendances')
            ->where('id', $request->id)
            ->first(['time_start as start', 'time_end as end', 'weekdays', 'subject_id', 'room_id', 'id']);

        $array = $this->weekDaysBetween(
            WeekdaysClassEnum::getWeekdays($q->weekdays),
            date('d-m-Y H:i:s', strtotime($q->start)),
            date('d-m-Y H:i:s', strtotime($q->end))
        );
        $arr = [];
        $i = 0;
        foreach ($array as $date) {
            if (explode(" ", $date['start'])[0] <= date('Y-m-d')) {
                $i++;
                $arr[$i] = explode(" ", $date['start'])[0];
            }

        }
        $check = Attendance::query()
            ->where('classSchedule_id', $request->id)
            ->where(function ($query) use ($arr) {
                foreach ($arr as $date) {
                    $query->orWhere('date', $date);
                }
            })
            ->get(['date']);


        return [$arr, $check->all()];
    }

    function getNextweekDays($requiredDays, $start, $end, $shift)
    {
        $startTime = Carbon::createFromFormat('d-m-Y', $start);
        $endTime = Carbon::createFromFormat('d-m-Y', $end);
        $result = [];
        $i = 0;
        while ($startTime->lt($endTime)) {

            if (in_array($startTime->dayOfWeek, $requiredDays)) {

                if (strtotime(date("Y-m-d H:i:s")) < strtotime(Carbon::parse($startTime->copy())->toDateTimeString())) {
                    $result[] = Carbon::parse($startTime->copy())->toDateTimeString();
                }

            }
            $startTime->addDay();
            $i++;
        }
        $interval = [];
        foreach ($result as $day) {

            $value = abs(strtotime(date("Y-m-d H:i:s")) - strtotime($day));
            $interval[] = $value;
        }

        if (empty($interval)) {
            return "";
        }
        asort($interval);
        $closest = key($interval);


        $date = date('d-m-Y', strtotime($result[$closest]));

        return "Buổi " . $shift . " - Thứ " . date('w', strtotime($result[$closest])) . " Ngày " . $date;
    }

    function weekDaysBetween($requiredDays, $start, $end, $title = '', $id = null, $arr = null, $arr2 = null)
    {


        $startTime = Carbon::createFromFormat('d-m-Y H:i:s', $start);
        $endTime = Carbon::createFromFormat('d-m-Y H:i:s', $end);

        $result = [];
        $i = 0;

        while ($startTime->lt($endTime)) {

            if (in_array($startTime->dayOfWeek, $requiredDays)) {
                $result[$i]['title'] = $title;

                $result[$i]['start'] = Carbon::parse($startTime->copy())->format('Y-m-d H:i:s') ;

                $result[$i]['end'] = Carbon::parse($startTime->copy()->addHours(4))->format('Y-m-d H:i:s');

                $result[$i]['id'] = $id;
                if (!is_null($arr)) {
                    $check = date("Y-m-d", strtotime($result[$i]['start']));
                    $keys = array_column($arr, $result[$i]['id'] . "");
                    $index = array_search($check, $keys);
                    if ($index !== false) {
                        $result[$i]['color'] = 'green';
                    }
                }
                if (!is_null($arr2)) {
                    $check = date("Y-m-d", strtotime($result[$i]['start']));
                    $keys = array_column($arr2, $result[$i]['id'] . "");
                    $index = array_search($check, $keys);
                    if ($index !== false) {
                        $result[$i]['color'] = 'red';
                    }
                }
            }
            $startTime->addDay();
            $i++;
        }
        return array_values($result);
    }

    public function getWeekdays(Request $request)
    {
        $weekdays = WeekdaysClassEnum::getViewArray();
        if ($request->id == 3) {

            $weekdays = array_slice($weekdays, -2);

            return response()->json($weekdays);
        }

        return response()->json($weekdays);
    }

    //fix ngay hoc trung
    public function getRooms(Request $request)
    {
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $shift = $request->shift;
        $weekdays = $request->weekdays;
        $model = Room::query();

        $room = $this->exceptObject($model, $weekdays, $shift, $time_start, $time_end);

        return response()->json($room);
    }

    public function exceptObject($model, $weekdays, $shift, $time_start, $time_end)
    {
        $weekdaysEnums = WeekdaysClassEnum::getArrayExcept($weekdays);
        return $model
            ->whereDoesntHave('classSchedules', function ($query) use ($weekdays, $shift, $time_start, $time_end, $weekdaysEnums) {
                $query
                    ->where('shift', $shift)
                    ->whereIn('weekdays', $weekdaysEnums)
                    ->where(function ($query1) use ($time_start, $time_end) {
                        $query1->where(function ($query2) use ($time_start, $time_end) {
                            $query2->whereDate('time_start', '<=', $time_start)
                                ->whereDate('time_end', '>=', $time_start);
                        })
                            ->orWhere(function ($query2) use ($time_start, $time_end) {
                                $query2->whereDate('time_start', '<=', $time_end)
                                    ->whereDate('time_end', '>=', $time_end);

                            });
                    });
            })->get();
    }


    public function getTeachers(Request $request)
    {

        $teachersRegister = RegisterTeach::query()
            ->where('weekdays', $request->weekdays)
            ->where('shift', $request->shift)
            ->where('subject_id', $request->subject)
            ->get();

        $arr = [];
        if ($teachersRegister) {
            foreach ($teachersRegister as $teacher) {
                $arr[] = $teacher->teacher_id;
            }
        }

        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $shift = $request->shift;
        $weekdays = $request->weekdays;
        $model = Teacher::query()->where('level', 1);
        $teachers = $this->exceptObject($model, $weekdays, $shift, $time_start, $time_end);
        $data = [$teachers, $arr];
        return response()->json($data);
    }

    public function updateTeacher(Request $request)
    {
        $class_id = $request->class_id;
        $teacher_id = $request->teacher_id;

        ClassSchedule::query()
            ->where('id', $class_id)->update(['teacher_id' => $teacher_id]);
        RegisterTeach::query()->where('teacher_id', $teacher_id)->update(['status' => 1, 'classSchedule_id' => $class_id]);
        return response()->json(['status' => 200]);
    }


}

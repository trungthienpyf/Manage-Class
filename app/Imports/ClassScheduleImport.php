<?php

namespace App\Imports;

use App\Enums\ShiftClassEnum;
use App\Enums\TimeLineEnum;
use App\Enums\WeekdaysClassEnum;
use App\Models\ClassSchedule;
use App\Models\ClassStudent;
use App\Models\Student;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassScheduleImport implements ToArray, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
       public $message='Import thành công';
    public function array(array $array)
    {

        try{
            foreach($array as $each){


            $name = $each["ten"];
            $email = $each["email"];
            $phone = $each["sdt"];
            $password = $each["mk"];
            $subjectName = $each["ten_ct"];
            $shift = $each["ca"];
            $weekdays = $each["ngay_hoc"];
            $time_line = $each["tuan_hoc"];
            $student=Student::query()->where('email',$email)->first();
            if(!$student){
                $student= Student::create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => $password,
                ]);
            }

            $subject= Subject::query()->where('name',$subjectName)->first();
            if($subject==null){
                throw new \Exception("Không tìm thấy môn học");
            }


                $classSchedule = ClassSchedule::query()->where('subject_id',$subject->id)
                ->where('status',0)
                ->where('shift',ShiftClassEnum::getShiftEnum($shift))
                ->where('weekdays',WeekdaysClassEnum::getValueWeekdaysEnum($weekdays))
                ->where('time_line',TimeLineEnum::getValueTimeLineEnum($time_line))
                ->first();


            if($classSchedule==null){
                $time_start= date("Y-m-d", strtotime(" +3 week"));

                    $time_end= date("Y-m-d", strtotime($time_start." +2 week"));
              if(TimeLineEnum::getTimeWeekEnum($time_line)==5) {
                    $time_end = date("Y-m-d", strtotime($time_start . " +5 week"));
                }else if(TimeLineEnum::getTimeWeekEnum($time_line)==7) {
                    $time_end = date("Y-m-d", strtotime($time_start . " +7 week"));
                }


                $timeOfShift= ShiftClassEnum::getTimeOfShiftReturn($shift);

                $classSchedule= ClassSchedule::create([
                    'shift'=>ShiftClassEnum::getShiftEnum($shift),
                    'weekdays'=>WeekdaysClassEnum::getValueWeekdaysEnum($weekdays),
                    'time_line'=>TimeLineEnum::getValueTimeLineEnum($time_line),
                    'time_start' => $time_start ." ".$timeOfShift[0],
                    'time_end' => $time_end ." ".$timeOfShift[0],
                    'subject_id'=>$subject->id,
                ]);

            }
            $checkExist=ClassStudent::query()->where('classSchedule_id',$classSchedule->id)
                    ->where('student_id',$student->id)
                    ->first();
                if($checkExist){
                    throw new \Exception("Học viên đã tồn tại trong lớp cần học");
                }
            $classSchedule->students()->attach($student->id);
            }
        }catch(\Exception $e){
             $this->message=$e->getMessage();
        }

    }
}

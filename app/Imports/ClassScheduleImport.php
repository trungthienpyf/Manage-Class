<?php

namespace App\Imports;

use App\Enums\ShiftClassEnum;
use App\Enums\TimeLineEnum;
use App\Enums\WeekdaysClassEnum;
use App\Models\ClassSchedule;
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
            $student= Student::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
            ]);
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
                throw new \Exception("Không tìm thấy lớp học");
            }
            $classSchedule->students()->attach($student->id);
            }
        }catch(\Exception $e){
               $this->message= $e->getMessage();
        }

    }
}

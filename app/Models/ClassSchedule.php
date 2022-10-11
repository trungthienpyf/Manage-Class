<?php

namespace App\Models;

use App\Enums\ShiftClassEnum;
use App\Enums\WeekdaysClassEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClassSchedule extends Model
{


    use HasFactory;
    protected $fillable=[

        'shift',
        'weekdays',
        'time_line',
        'time_start',
        'time_end',
        'subject_id',
        'room_id',
        'teacher_id',

    ];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_students', 'classSchedule_id', 'student_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getNameScheduleAttribute()
    {
        $weeksday = implode("-", WeekdaysClassEnum::getWeekdays($this->weekdays));

        return $this->subject->name . " " . $weeksday;
    }

    public function getNameWeekdayAttribute()
    {
        $weeksday = WeekdaysClassEnum::getWeekdays($this->weekdays);

        return   "Thứ " . implode('-', $weeksday);
    }
    public function getNameShiftAttribute(){
        return ShiftClassEnum::getShift($this->shift);
    }
    public function getStudentCountAttribute(){
        return $this->students->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'classSchedule_id',
        'teacher_id',
        'date',
    ];
    public function AttendanceStudents()
    {
        return $this->belongsToMany(Student::class, 'attendance_students', 'attendance_id', 'student_id')->withPivot('status','student_id');
    }
    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class,'classSchedule_id');
    }
}

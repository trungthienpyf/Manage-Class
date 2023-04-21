<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    public $table = "students";
    use HasFactory;
    protected $fillable=['name','password','phone','email','img'];
    public function classSchedules() {
        return $this->belongsToMany(ClassSchedule::class, 'class_students', 'student_id', 'classSchedule_id');
    }
    public function AttendanceStudents()
    {
        return $this->belongsToMany(Attendance::class, 'attendance_students', 'student_id', 'attendance_id');
    }
}

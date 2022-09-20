<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    public $table = "students";
    use HasFactory;
    protected $fillable=['name','password','phone','email'];
    public function classSchedules() {
        return $this->belongsToMany(ClassSchedule::class, 'class_students', 'student_id', 'classSchedule_id');
    }
}

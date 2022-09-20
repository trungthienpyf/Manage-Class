<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClassSchedule extends Model
{

    public $timestamps=false;
    use HasFactory;
    public function students() {
        return $this->belongsToMany(Student::class, 'class_students', 'classSchedule_id', 'student_id');
    }
}

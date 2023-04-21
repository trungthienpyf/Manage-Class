<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendance_id',
        'student_id',
        'status',
    ];
    public $timestamps=false;
  // protected $primaryKey = ['attendance_id', 'student_id'];
}

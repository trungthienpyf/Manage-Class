<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClassStudent extends Model
{
    use HasFactory;
    protected $primaryKey = ['classSchedule_id', 'student_id'];
    protected $fillable=[
        'classSchedule_id',
        'student_id',
        'status',
        'payment',
    ];
    public $timestamps=false;
    public $incrementing = false;
}

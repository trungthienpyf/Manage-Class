<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessture extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'total_quizzes',

    ];
    public function classes()
    {
        return $this->belongsToMany(ClassSchedule::class, 'class_lesstures', 'lessture_id', 'classSchedule_id')->withPivot('classSchedule_id');
    }
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }
}

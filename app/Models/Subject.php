<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable=['name','price'];
    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

}

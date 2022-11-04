<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterTeach extends Model
{
    use HasFactory;
    protected $fillable=['weekdays','shift','teacher_id','room_id','subject_id','class_id'];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

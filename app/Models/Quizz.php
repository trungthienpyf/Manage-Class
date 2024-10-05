<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use HasFactory;
    protected $fillable= [
        'question',
        'lessture_id',

    ];
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function lessture()
    {
        return $this->belongsTo(Answer::class);
    }

}

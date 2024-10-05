<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable= [
        'optionA',
        'optionB',
        'optionC',
        'optionD',
        'correct_option',
        'answer_text',
        'quizz_id',

    ];

    public function quizz()
    {
        return $this->belongsTo(Answer::class);
    }
}

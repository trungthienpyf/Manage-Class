<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Lessture;
use App\Models\Quizz;
use Illuminate\Http\Request;

class ChooseQuizzController extends Controller {
    public function index($id)
    {
        View()->share('title', 'Bài tập');


        return view('student.quizz_index' ,[

//       'lesstures' => Lessture::query()->with('attempts')->get()
            'lesstures' => Lessture::query()->whereHas('classes', function ($q) use ($id) {
                $q->where('classSchedule_id', $id);
            })->get()
        ]);
    }
    public function detail($id)
    {
        View()->share('title', 'Bài tập');


        return view('student.quizz',
            [
                'lessture_id'=>$id,
                'id'=>Lessture::find($id)->classes()->get()->first()->pivot->classSchedule_id,
            ]);
    }
    public function getQuestionByLecture(Request $request)
    {
        View()->share('title', 'Bài tập');

       return Quizz::query()->with('answers')
            ->where('lessture_id',$request->lessture_id)->get()->map(function ($e){
                return [
                    'question'=>$e->question,
                    'options'=>[$e->answers[0]->optionA, $e->answers[0]->optionB,$e->answers[0]->optionC, $e->answers[0]->optionD],
                    'correct'=> $e->answers[0]->correct_option,
                ];
           });

    }

    public function addAttempt(Request $request)
    {
        Attempt::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'lessture_id' => $request->lessture_id,
            ]
            , ['total_score' => $request->total_score]
        );

    }
}

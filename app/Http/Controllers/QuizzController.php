<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Attempt;
use App\Models\ClassLessture;
use App\Models\ClassSchedule;
use App\Models\Lessture;
use App\Models\Quizz;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        View()->share('title', 'Bài tập');


        return view('teacher.quizz.index', [

            'lesstures' => Lessture::query()->get()

        ]);
    }

    public function indexByClass($id)
    {
        View()->share('title', 'Bài tập');


        return view('teacher.quizz.index', [

            'lesstures' => Lessture::query()->whereHas('classes', function ($q) use ($id) {
                $q->where('classSchedule_id', $id);
            })->get(),
            'lessture_id'=>$id

        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create($id)
    {

        View()->share('title', 'Bài tập');
        return view('teacher.quizz.create', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lessture = new Lessture();
        $lessture->name = $request->title;
        $lessture->total_quizzes = 0;

        $lessture->save();
        $class = ClassSchedule::find($request->class_id);

        $class->lesstures()->attach($lessture->id);
        $content_quizz = $request->content_quizz;
        $A = $request->A;
        $B = $request->B;
        $C = $request->C;
        $D = $request->D;
        $correct_option = $request->correct_option;
        $i = 0;
        foreach ($content_quizz as $key => $value) {
            $i++;
            $quizz = Quizz::create([
                'question' => $value,
                'lessture_id' => $lessture->id,
            ]);
            Answer::create([
                'optionA' => $A[$key],
                'optionB' => $B[$key],
                'optionC' => $C[$key],
                'optionD' => $D[$key],
                'correct_option' => $correct_option[$key],
                'quizz_id' => $quizz->id
            ]);
        }
        $lessture->total_quizzes = $i;
        return redirect()->route('teacher.quizz.indexByClass',$request->class_id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {


        return view('teacher.quizz.update', [
            'lessture' => Lessture::query()->where('id', $id)->get()->first(),
            'quizzs' => Quizz::query()->with('answers')->where('lessture_id', $id)->get(),
            'class_id'=>$id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $lessture = Lessture::query()->find($request->id);

        $lessture->name = $request->title;
        $lessture->total_quizzes = 0;

        $lessture->save();

        $content_quizz = $request->content_quizz;
        $A = $request->A;
        $B = $request->B;
        $C = $request->C;
        $D = $request->D;
        $correct_option = $request->correct_option;
        $i = 0;



        foreach ($content_quizz as $key => $value) {
            $i++;

            $quizz = Quizz::updateOrCreate(
                ['lessture_id' => $lessture->id, 'question' => $value]
                , [


            ]);
            Answer::updateOrCreate(
                ['quizz_id' => $quizz->id],

                [
                    'optionA' => $A[$key],
                    'optionB' => $B[$key],
                    'optionC' => $C[$key],
                    'optionD' => $D[$key],
                    'correct_option' => $correct_option[$key],
                ]
            );
        }
        $lessture->total_quizzes = $i;
        $lessture->save();

        return redirect()->route('teacher.quizz.indexByClass',Lessture::find($request->class_id)->classes()->get()->first()->pivot->classSchedule_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

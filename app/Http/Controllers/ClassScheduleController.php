<?php

namespace App\Http\Controllers;

use App\Enums\ShiftClassEnum;
use App\Enums\TimeLineEnum;
use App\Enums\WeekdaysClassEnum;
use App\Models\ClassSchedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        View::share('title', 'Lớp học');


        $classes = ClassSchedule::all();

        return view('admin.class.index', [
            'classes' => $classes,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        View::share('title', 'Thêm lớp');

        $subjects = Subject::all();
        $timeLines = TimeLineEnum::getViewArray();
        $shifts = ShiftClassEnum::getViewArray();
        $weekdays= WeekdaysClassEnum::getViewArray();
        $weekdays=  array_slice($weekdays, 0,6);
        return view('admin.class.create',[
            'subjects'=>$subjects,
            'timeLines'=>$timeLines,
            'shifts'=>$shifts,
            'weekdays'=>$weekdays,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        ClassSchedule::create($request->all());
        return redirect()->route('admin.class.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

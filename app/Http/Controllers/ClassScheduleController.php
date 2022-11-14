<?php

namespace App\Http\Controllers;

use App\Enums\ShiftClassEnum;
use App\Enums\TimeLineEnum;
use App\Enums\WeekdaysClassEnum;
use App\Http\Requests\StoreClassRequest;
use App\Imports\ClassScheduleImport;
use App\Models\ClassSchedule;
use App\Models\RegisterTeach;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        View::share('title', 'Lớp học');


        $q = ClassSchedule::query();
            if($request->teacher){
                $q->whereHas('teacher', function ($query) use ($request) {
                    $query->where('id',  $request->teacher );
                });
            }
        if($request->time ){
            if($request->time == 3 ){
                $q->where('status', 1 )->where('time_end', '<', date('Y-m-d H:i:s'));
            }else if($request->time == 2) {

                $q->where('status', 1 )->where('time_end', '>', date('Y-m-d H:i:s'));

            }else{
                $q->where('status', 0 );

            }

        }
    $classes=$q->get();
        return view('admin.class.index', [
            'classes' => $classes,
            'teachers' => Teacher::query()->where('level', 1)->get(),
        ]);
    }
    public function importCsv(Request $request)
    {
        $import = new ClassScheduleImport;
      Excel::import($import, $request->file('csv'));
    $message=  $import->message;

        return redirect()->route('admin.class.index')->with('message', $message);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClassRequest $request)
    {
        //

        $time_start  =$request->time_start;
        $time_end  =$request->time_end;
       $timeOfShift= ShiftClassEnum::getTimeOfShift($request->shift);
        $request->merge([
            'time_start' => $time_start ." ".$timeOfShift[0],
            'time_end' => $time_end ." ". $timeOfShift[1],
        ]);
      $class=  ClassSchedule::create($request->all());
        RegisterTeach::query()->where('teacher_id', $request->teacher_id)->update(['status' => 1, 'classSchedule_id' => $class->id]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        ClassSchedule::find($id)->forceDelete();
        return redirect()->route('admin.class.index');
    }
}

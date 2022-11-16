<?php

namespace App\Http\Controllers;

use App\Enums\ShiftClassEnum;
use App\Enums\WeekdaysClassEnum;
use App\Http\Requests\StoreRegisterTeachRequest;
use App\Models\RegisterTeach;
use App\Models\Subject;
use Illuminate\Http\Request;

class RegisterTeachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        View()->share('title', 'Đăng ký dạy');
        $history = RegisterTeach::query()
            ->where('teacher_id', auth()->user()->id)
            ->get();

        return view('teacher.register.index', [
            'history' => $history
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        View()->share('title', 'Tạo yêu cầu đăng ký');
        return view('teacher.register.create', [
            'subjects' => Subject::all(),
            'weekdays' => WeekdaysClassEnum::getViewArray(),
            'shifts' => ShiftClassEnum::getViewArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRegisterTeachRequest $request)
    {
        $register = new RegisterTeach();
        $register->teacher_id = auth()->user()->id;
        $register->subject_id = $request->subject;
        $register->weekdays = $request->weekdays;
        $register->shift = $request->shift;
        $register->status=0;
        $register->save();
        return redirect()->route('teacher.register.index');
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
        RegisterTeach::find($id)->delete();
        return redirect()->route('teacher.register.index');
    }
}

<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\View;

class ClassScheduleController extends Controller
{
    public function index()
    {
        View::share('title', 'Class');
        return view('admin.class.index');
    }
}

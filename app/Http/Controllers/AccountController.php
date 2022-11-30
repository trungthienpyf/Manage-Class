<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function viewLogin()
    {
        if(Auth::guard('student')->check()) {
            return redirect()->route('student');
        }
        if (Auth::check()) {
            return redirect()->route('admin');
        }
        return view('login');
    }
    public function viewRegister(){
        if(Auth::guard('student')->check()) {
            return redirect()->route('student');
        }
        if (Auth::check()) {
            return redirect()->route('admin');
        }
        return view('register');
    }
    public function  signup(StoreStudentRequest $request){
      $student=  Student::create($request->all());
        Auth::guard('student')->login($student);
        return redirect()->route('student');

    }
    public function login(Request $request)
    {
        $student = Student::where(function ($query) use ($request) {
            $query ->orWhere('email', $request->email)
                ->orWhere('id', $request->email);
        })


            ->where('password', $request->password)
            ->first();
        $teacher = Teacher::where('id', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($student) {
            Auth::guard('student')->login($student);


            return redirect()->route('student');
        }
        if ($teacher) {
            if($teacher->level==1){
                Auth::login($teacher);
                return redirect()->route('teacher.post');
            }else{
                Auth::login($teacher);
                return redirect()->route('admin');
            }


        }
        return redirect()->back();

    }

    public function logout()
    {
         Auth::logout();
         Auth::guard('student')->logout();

        return redirect()->route('login');
    }
}

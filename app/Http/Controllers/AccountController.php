<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class AccountController extends Controller
{

    public function redirectToGoogle()
    {
        // redirect user to "login with Google account" page
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            // get user data from Google
            $user = Socialite::driver('google')->user();

            // find user in the database where the social id is the same with the id provided by Google
            $finduser = Student::where('social_id', $user->id)->first();

            if ($finduser)  // if user found then do this
            {
                // Log the user in

                Auth::guard('student')->login($finduser);

                // redirect user to dashboard page
                return redirect()->route('student');
            }
            else
            {
                // if user not found then this is the first time he/she try to login with Google account
                // create user data with their Google account data

                $newUser = Student::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',  // the social login is using google
                    'password' => bcrypt('my-google'),  // fill password by whatever pattern you choose
                ]);
                Auth::guard('student')->login($newUser);


                return redirect()->route('student');
            }

        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

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

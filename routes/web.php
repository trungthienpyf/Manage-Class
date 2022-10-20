<?php

use App\Http\Controllers\AccountController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\ScheduleTeacherController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AccountController::class, 'viewLogin'])->name('login');
Route::get('/test', [TestController::class, 'test'])->name('login');
Route::get('/login', [AccountController::class, 'viewLogin'])->name('login');
Route::get('/register', [AccountController::class, 'viewRegister'])->name('register');
Route::post('/signin', [AccountController::class, 'login'])->name('signin');
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
Route::middleware(['auth','role:0'])->group(function () {
    Route::get('/admin', function () {
        View::share('title', 'Admin');
        return view('index');
    })->name('admin');
    Route::name("admin.")->prefix('admin')->group(function () {
        Route::resources([
            'class' => ClassScheduleController::class,
        ]);
    });
});
Route::middleware(['auth','role:1'])->group(function () {
    Route::get('/teacher', function () {
        View::share('title', 'Teacher');
        return view('teacher.index');
    })->name('teacher');
    Route::name("teacher.")->prefix('teacher')->group(function () {
        Route::get('/schedule',[ScheduleTeacherController::class, 'index'])->name('index');
        Route::get('/attendance',[AttendanceController::class, 'index'])->name('index');
        Route::post('/attendance',[AttendanceController::class, 'attendance'])->name('attendance');
    });
});


Route::middleware(['auth:student'])->group(function () {
    Route::get('/student', function () {
        View::share('title', 'Student');
        return view('calendar');
    })->name('student');

});
//Route::get('/getSchedule', [ApiController::class,'getSchedule'])->name('getSchedule');

<?php

use App\Http\Controllers\AccountController;

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
Route::get('/', [AccountController::class,'viewLogin'])->name('login');
Route::get('/login', [AccountController::class,'viewLogin'])->name('login');
Route::get('/register', [AccountController::class,'viewRegister'])->name('register');
Route::post('/signin', [AccountController::class,'login'])->name('signin');
Route::get('/logout', [AccountController::class,'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
Route::get('/teacher', function () {
    View::share('title', 'Teacher');
    return view('index');
})->name('admin');
});
Route::middleware(['auth:student'])->group(function () {
    Route::get('/student', function () {
        View::share('title', 'Student');
        return view('calendar');
    })->name('student');

});
//Route::get('/getSchedule', [ApiController::class,'getSchedule'])->name('getSchedule');

<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', [AccountController::class,'viewLogin'])->name('login');
Route::get('/register', [AccountController::class,'viewRegister'])->name('register');
Route::post('/signin', [AccountController::class,'login'])->name('signin');
Route::get('/logout', [AccountController::class,'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
Route::get('/teacher', function () {
    return view('index');
})->name('admin');
});
Route::middleware(['auth:student'])->group(function () {
    Route::get('/student', function () {
        return view('index');
    })->name('student');

});
//Route::get('/getSchedule', [ApiController::class,'getSchedule'])->name('getSchedule');

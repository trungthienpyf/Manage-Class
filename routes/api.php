<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getSchedule', [ApiController::class,'getSchedule'])->name('getSchedule');
Route::get('/getScheduleTeacher', [ApiController::class,'getScheduleTeacher'])->name('getScheduleTeacher');
Route::post('/getWeekdays', [ApiController::class,'getWeekdays'])->name('getWeekdays');
Route::post('/getTeachers', [ApiController::class,'getTeachers'])->name('getTeachers');
Route::post('/getDateAttendance', [ApiController::class,'getDateAttendance'])->name('getDateAttendance');



Route::post('/getRooms', [ApiController::class,'getRooms'])->name('getRooms');

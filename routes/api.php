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
Route::get('/getListStudentByIdClass', [ApiController::class,'getListStudentByIdClass'])->name('getListStudentByIdClass');
Route::get('/getScheduleTeacher', [ApiController::class,'getScheduleTeacher'])->name('getScheduleTeacher');
Route::get('/AttendanceAi', [ApiController::class,'AttendanceAi'])->name('AttendanceAi');
Route::get('/AttendanceStudentAi', [ApiController::class,'AttendanceStudentAi'])->name('AttendanceStudentAi');
Route::get('/CreateAttendance', [ApiController::class,'CreateAttendance'])->name('CreateAttendance');
Route::post('/getWeekdays', [ApiController::class,'getWeekdays'])->name('getWeekdays');
Route::post('/getTeachers', [ApiController::class,'getTeachers'])->name('getTeachers');
Route::post('/updateTeacher', [ApiController::class,'updateTeacher'])->name('updateTeacher');
Route::post('/getDateAttendance', [ApiController::class,'getDateAttendance'])->name('getDateAttendance');



Route::post('/getRooms', [ApiController::class,'getRooms'])->name('getRooms');

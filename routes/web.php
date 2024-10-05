<?php

use App\Http\Controllers\AccountController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChooseQuizzController;
use App\Http\Controllers\ClassOfMineController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\RegisterTeachController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleTeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\PreventRouteMiddleware;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
Route::get('/signup', [AccountController::class, 'signup'])->name('signup');
Route::post('/signin', [AccountController::class, 'login'])->name('signin');
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
Route::get('auth/google', [AccountController::class, 'redirectToGoogle']);  // redirect to google login
Route::get('callback/google', [AccountController::class, 'handleCallback']);    // callback route after google account chosen
Route::middleware(['auth', 'role:2'])->group(function () {

    Route::get('/admin', [PostController::class, 'index'])->name('admin');
    Route::post('/admin', [PostController::class, 'store'])->name('admin.post');
    Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('admin.post.destroy');

    Route::name("admin.")->prefix('admin')->group(function () {
        Route::resources([
            'class' => ClassScheduleController::class,
        ]);
        Route::resources([
            'teacher' => TeacherController::class,
        ]);
        Route::resources([
            'room' => RoomController::class,
        ]);
        Route::resources([
            'subject' => SubjectController::class,
        ]);
        Route::post('/class/import', [ClassScheduleController::class, 'importCsv'])->name('importCsv');
        Route::get('/statistic', [ClassScheduleController::class, 'statistic'])->name('statistic');
    });
});


Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/teacher', function () {
        View::share('title', 'Teacher');
        return view('teacher.index');
    })->name('teacher');
    Route::name("teacher.")->prefix('teacher')->group(function () {
        Route::get('/schedule', [ScheduleTeacherController::class, 'index'])->name('schedule');
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
        Route::get('/attendance_ai', [AttendanceController::class, 'attendance_ai'])->name('attendance_ai');
        Route::get('/post', [PostController::class, 'indexTeacher'])->name('post');
        Route::get('/classTeacher', [ClassOfMineController::class, 'indexTeacher'])->name('classTeacher');
        Route::get('/indexByClass/{id}', [QuizzController::class, 'indexByClass'])->name('quizz.indexByClass');
        Route::get('/indexByClass/{id}/create', [QuizzController::class, 'create'])->name('quizz.create');
        Route::get('/indexByClass/{id}/edit', [QuizzController::class, 'edit'])->name('quizz.edit');
        Route::put('/indexByClass/update', [QuizzController::class, 'update'])->name('quizz.update');
        Route::post('/indexByClass/store', [QuizzController::class, 'store'])->name('quizz.store');

        Route::post('/getAttendanceClass', [AttendanceController::class, 'getAttendanceClass'])->name('getAttendanceClass');
        Route::post('/attendance', [AttendanceController::class, 'attendance'])->name('attendanceStudent');
        Route::resources([
            'register' => RegisterTeachController::class,
        ]);

    });
});


Route::middleware(['auth:student'])->group(function () {
    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::get('/post', [PostController::class, 'indexStudent'])->name('post');
    Route::get('/student/calendar', [StudentController::class, 'viewCalendar'])->name('viewCalendar');
    Route::get('/classStudent', [ClassOfMineController::class, 'indexStudent'])->name('classStudent');
    Route::get('/registerImage', [ClassOfMineController::class, 'registerImage'])->name('registerImage');
    Route::get('/progress/{progress}', [StudentController::class, 'progress'])->name('progress')->middleware(PreventRouteMiddleware::class);
    Route::post('/payment', [StudentController::class, 'paymentQR'])->name('payment');
    Route::get('/resultPayment', [StudentController::class, 'resultPayment'])->name('resultPayment');
    Route::get('/quizz/{id}', [ChooseQuizzController::class, 'index'])->name('quizz.index');
    Route::get('/quizz_detail/{id}', [ChooseQuizzController::class, 'detail'])->name('quizz.detail');
    Route::get('/getQuestionByLecture', [ChooseQuizzController::class, 'getQuestionByLecture'])->name('getQuestionByLecture');
    Route::get('/addAttempt', [ChooseQuizzController::class, 'addAttempt'])->name('addAttempt');

    Route::get('/camera', [StudentController::class,'image'])->name('camera');
    Route::get('/camera/upload', [StudentController::class,'delete'])->name('camera.upload');
    Route::post('/camera/upload', [StudentController::class,'upload'])->name('camera.upload');

    Route::post('/upload/image', function (Request $request) {
        $image = $request->file('image');
        $id = (int)auth()->user()->id;

        $image->move('D:/FaceRecog/Resources', $id . "." . $image->getClientOriginalExtension());
        File::copy('D:/FaceRecog/Resources/' . $id . "." . $image->getClientOriginalExtension(), public_path('img') . '/' . $id . "." . $image->getClientOriginalExtension());

        Student::query()->where("id", $id)->update(['img' => $id . "." . $image->getClientOriginalExtension()]);

        return redirect()->route('registerImage');
    })->name('upload.image');
});

//Route::get('/getSchedule', [ApiController::class,'getSchedule'])->name('getSchedule');

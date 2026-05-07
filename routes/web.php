<?php

use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherProfileController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;

// Public Routes
Route::get('/', function () {
    return view('EduFlow.home');
});

Route::get('/login', [UserController::class, 'showLoginChoice'])->name('login');
Route::get('/loginForm/{role}', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::get('/admin/login', [UserController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [UserController::class, 'adminLogin'])->name('admin.login.submit');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'adminDashboard'])->name('dashboard');

    //User Admin Routes
    Route::get('/users', [UserController::class, 'adminUserList'])->name('user.list');

    //Subject Admin Routes
    Route::get('/subject', [SubjectController::class, 'index'])->name('subject.list');
    Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subject', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('/subject/{subject}', [SubjectController::class, 'show'])->name('subject.show');
    Route::get('/subject/{subject}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::put('/subject/{subject}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('/subject/{subject}', [SubjectController::class, 'destroy'])->name('subject.destroy');

    //Teacher Admin Routes
    Route::get('/teacher', [TeacherProfileController::class, 'index'])->name('teacher.list');
    Route::get('/teacher/create', [TeacherProfileController::class, 'create'])->name('teacher.create');
    Route::post('/teacher', [TeacherProfileController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{teacher}', [TeacherProfileController::class, 'show'])->name('teacher.show');
    Route::get('/teacher/{teacher}/edit', [TeacherProfileController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{teacher}', [TeacherProfileController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{teacher}', [TeacherProfileController::class, 'destroy'])->name('teacher.destroy');

    //Student Admin Routes
    Route::get('/student', [StudentProfileController::class, 'index'])->name('student.list');
    Route::get('/student/create', [StudentProfileController::class, 'create'])->name('student.create');
    Route::post('/student', [StudentProfileController::class, 'store'])->name('student.store');
    Route::get('/student/{student}', [StudentProfileController::class, 'show'])->name('student.show');
    Route::get('/student/{student}/edit', [StudentProfileController::class, 'edit'])->name('student.edit');
    Route::put('/student/{student}', [StudentProfileController::class, 'update'])->name('student.update');
    Route::delete('/student/{student}', [StudentProfileController::class, 'destroy'])->name('student.destroy');

    //Subject Class Admin Routes
    Route::get('/class-subjects/create', [ClassSubjectController::class, 'create'])->name('class-subject.create');
    Route::post('/class-subjects/store', [ClassSubjectController::class, 'store'])->name('class-subject.store');
    Route::get('/class-subjects', [ClassSubjectController::class, 'index'])->name('class-subject.list');
    Route::delete('/class-subjects/{classSubject}', [ClassSubjectController::class, 'destroy'])->name('class-subject.destroy');

    //Classes Admin Routes
    Route::get('/classes', [\App\Http\Controllers\ClassesController::class, 'index'])->name('classes.list');
    Route::get('/classes/create', [\App\Http\Controllers\ClassesController::class, 'create'])->name('classes.create');
    Route::post('/classes', [\App\Http\Controllers\ClassesController::class, 'store'])->name('classes.store');
    Route::get('/classes/{class}', [\App\Http\Controllers\ClassesController::class, 'show'])->name('classes.show');
    Route::get('/classes/{class}/edit', [\App\Http\Controllers\ClassesController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{class}', [\App\Http\Controllers\ClassesController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{class}', [\App\Http\Controllers\ClassesController::class, 'destroy'])->name('classes.destroy');
    Route::delete('/classes-bulk', [\App\Http\Controllers\ClassesController::class, 'bulkDestroy'])->name('classes.bulk-destroy');

    //Routine Admin Routes
    Route::get('/routine', [\App\Http\Controllers\RoutineController::class, 'index'])->name('routine.index');
    Route::get('/routine/class-subjects', [\App\Http\Controllers\RoutineController::class, 'getClassSubjects'])->name('routine.class-subjects');
    Route::get('/routine/create', [\App\Http\Controllers\RoutineController::class, 'create'])->name('routine.create');
    Route::post('/routine', [\App\Http\Controllers\RoutineController::class, 'store'])->name('routine.store');
    Route::get('/routine/{routine}/edit', [\App\Http\Controllers\RoutineController::class, 'edit'])->name('routine.edit');
    Route::put('/routine/{routine}', [\App\Http\Controllers\RoutineController::class, 'update'])->name('routine.update');
    Route::delete('/routine/{routine}', [\App\Http\Controllers\RoutineController::class, 'destroy'])->name('routine.destroy');

});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'teacherDashboard'])->name('dashboard');
    Route::get('/courses', [TeacherController::class, 'courses'])->name('courses');
    Route::get('/students', [TeacherController::class, 'students'])->name('students');
    Route::get('/profile', [TeacherController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [TeacherController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [TeacherController::class, 'updateProfile'])->name('profile.update');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'studentDashboard'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\StudentController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [\App\Http\Controllers\StudentController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\StudentController::class, 'updateProfile'])->name('profile.update');
});

// Logout Route
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');


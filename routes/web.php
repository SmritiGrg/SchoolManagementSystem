<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

    //Subject Admin Routes
    Route::get('/subject', [SubjectController::class, 'index'])->name('subject.list');
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'teacherDashboard'])->name('dashboard');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'studentDashboard'])->name('dashboard');
});

// Logout Route
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');


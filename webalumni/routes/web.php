<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TracerStudyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout.beranda');
});

Route::get('/forum', function () {
    return view('layout.forum');
});

// DEBUG - Temporary debug route
Route::get('/debug/alumni/{id}', function ($id) {
    $alumni = \App\Models\Alumni::find($id);
    $tracerExists = \App\Models\TracerStudy::where('alumni_id', $id)->first();
    
    return response()->json([
        'user_id_requested' => $id,
        'alumni_found' => $alumni ? true : false,
        'alumni_data' => $alumni,
        'tracer_study_exists' => $tracerExists ? true : false,
        'tracer_study_data' => $tracerExists,
        'database_check' => \DB::select('SELECT * FROM alumni WHERE user_id = ?', [$id])
    ]);
})->middleware('auth');

// Public Auth Routes
Route::get('/daftar', [AuthController::class, 'registrationForm'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    
    // Profile picture upload
    Route::post('/profile-picture', [AuthController::class, 'updateProfilePicture'])->name('profile.picture.update');
    
    // Tracer Study Routes
    Route::get('/tracer-study', [TracerStudyController::class, 'showForm'])->name('tracer.form');
    Route::post('/tracer-study', [TracerStudyController::class, 'store'])->name('tracer.store');
});

// Alumni resource routes
Route::resource('alumni', AlumniController::class)->middleware('auth');

// Student resource routes (for future expansion)
Route::resource('student', 'App\Http\Controllers\StudentController')->middleware('auth');

// Teacher resource routes (for future expansion)
Route::resource('teacher', 'App\Http\Controllers\TeacherController')->middleware('auth');
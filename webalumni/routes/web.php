<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ForumController;
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

Route::get('/forum', [ForumController::class, 'index'])->name('forum');

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

// Alumni routes
Route::resource('alumni', AlumniController::class);

// Job vacancy routes, hanya untuk admin dan dosen
// Semua user login (mahasiswa, alumni, dosen, admin) bisa lihat daftar loker
// Semua user login bisa lihat daftar & detail loker
// routes/web.php

// Public
Route::get('/jobs', [JobVacancyController::class, 'index'])->name('jobs.index');
Route::get('/jobs/my-jobs', [JobVacancyController::class, 'myJobs'])->name('jobs.my_jobs'); 
Route::get('/jobs/{id}', [JobVacancyController::class, 'show'])->name('jobs.show')->where('id', '[0-9]+');

// Alumni only
Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::get('/jobs/create', [JobVacancyController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobVacancyController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobVacancyController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobVacancyController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobVacancyController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/my-jobs', [JobVacancyController::class, 'myJobs'])->name('jobs.my');
});

// Admin & Teacher
Route::middleware(['auth', 'role:admin,teacher'])->group(function () {
    Route::get('/admin/jobs', [JobVacancyController::class, 'adminIndex'])->name('jobs.admin');
    Route::post('/jobs/{id}/approve', [JobVacancyController::class, 'approve'])->name('jobs.approve');
    Route::post('/jobs/{id}/reject', [JobVacancyController::class, 'reject'])->name('jobs.reject');
});
// Alumni resource routes
Route::resource('alumni', AlumniController::class)->middleware('auth');

// Student resource routes (for future expansion)
Route::resource('student', 'App\Http\Controllers\StudentController')->middleware('auth');

// Teacher resource routes (for future expansion)
Route::resource('teacher', 'App\Http\Controllers\TeacherController')->middleware('auth');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TracerStudyController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\PeopleController;
use Illuminate\Container\Attributes\DB;

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

// PUBLIC PAGES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/lowongan', [JobVacancyController::class, 'index'])->name('lowongan');
Route::get('/events', [HomeController::class, 'events'])->name('events');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

// Public listing: mahasiswa aktif dan alumni
Route::get('/lists', [PeopleController::class, 'index'])->name('lists.index');

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

// Job Vacancy Routes - PUBLIK
Route::get('/jobs', [JobVacancyController::class, 'index'])->name('jobs.index');

Route::middleware('auth')->group(function () {
    // PENTING: Route /jobs/create HARUS di atas /jobs/{id}
    Route::get('/jobs/create', [JobVacancyController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobVacancyController::class, 'store'])->name('jobs.store');
    
    // My Jobs
    Route::get('/my-jobs', [JobVacancyController::class, 'myJobs'])->name('jobs.my-jobs');
    
    // Edit & Delete
    Route::get('/jobs/{id}/edit', [JobVacancyController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobVacancyController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobVacancyController::class, 'destroy'])->name('jobs.destroy');
});

// Route dengan parameter {id} HARUS paling bawah
Route::get('/jobs/{id}', [JobVacancyController::class, 'show'])->name('jobs.show');
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

// Temporary debug route to inspect DB content for lists page
Route::get('/debug/lists', function () {
    try {
        $students = \DB::select('SELECT * FROM students LIMIT 5');
        $alumni = \DB::select('SELECT * FROM alumni LIMIT 5');
        $studentsCount = \DB::table('students')->count();
        $alumniCount = \DB::table('alumni')->count();

        return response()->json([
            'students_count' => $studentsCount,
            'alumni_count' => $alumniCount,
            'students_sample' => $students,
            'alumni_sample' => $alumni,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

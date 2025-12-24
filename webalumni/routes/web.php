<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TracerStudyController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\PeopleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// PUBLIC PAGES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [HomeController::class, 'show_post'])->name('berita.show');
Route::get('/events', [HomeController::class, 'events'])->name('events');

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

// Public Auth Routes
Route::get('/daftar', [AuthController::class, 'registrationForm'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// =======================
// LOWONGAN KERJA - UNTUK SEMUA USER YANG LOGIN
// (Mahasiswa Aktif, Alumni, dan Admin bisa lihat)
// =======================
Route::middleware(['auth'])->group(function () {
    // Halaman list lowongan (READ ONLY untuk mahasiswa & alumni)
    Route::get('/lowongan', [JobVacancyController::class, 'index'])->name('jobs.index');
    
    // Detail lowongan (READ ONLY untuk mahasiswa & alumni)
    Route::get('/lowongan/{id}', [JobVacancyController::class, 'show'])->name('jobs.show');
});

// =======================
// ADMIN - KELOLA LOWONGAN KERJA
// (CRUD - Create, Read, Update, Delete)
// =======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // List semua lowongan untuk admin
    Route::get('/lowongan', [JobVacancyController::class, 'adminIndex'])->name('jobs.index');
    
    // Create lowongan baru
    Route::get('/lowongan/create', [JobVacancyController::class, 'create'])->name('jobs.create');
    Route::post('/lowongan', [JobVacancyController::class, 'store'])->name('jobs.store');
    
    // Edit & Update lowongan
    Route::get('/lowongan/{id}/edit', [JobVacancyController::class, 'edit'])->name('jobs.edit');
    Route::put('/lowongan/{id}', [JobVacancyController::class, 'update'])->name('jobs.update');
    
    // Delete lowongan
    Route::delete('/lowongan/{id}', [JobVacancyController::class, 'destroy'])->name('jobs.destroy');
});

// Protected Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    
    // Profile picture upload
    Route::post('/profile-picture', [AuthController::class, 'updateProfilePicture'])->name('profile.picture.update');
    
    // Profile Job Vacancies Upload
    Route::post('/profile/job-upload', [JobVacancyController::class, 'storeFromProfile'])->name('profile.jobs.store');
    
    // Tracer Study Routes
    Route::get('/tracer-study', [TracerStudyController::class, 'showForm'])->name('tracer.form');
    Route::post('/tracer-study', [TracerStudyController::class, 'store'])->name('tracer.store');
    
    // Alumni resource routes
    Route::resource('alumni', AlumniController::class);
    
    // Student resource routes (for future expansion)
    Route::resource('student', 'App\Http\Controllers\StudentController');
    
    // Teacher resource routes (for future expansion)
    Route::resource('teacher', 'App\Http\Controllers\TeacherController');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

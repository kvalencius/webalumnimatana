<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;

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

// user
Route::get('/daftar', [AuthController::class, 'registrationForm']);

Route::post('/daftar', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginForm']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profil', [AuthController::class, 'profil'])->middleware('auth');

//alumni
Route::resource('alumni', AlumniController::class);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Forum Routes - Public (Read & Write)
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts/{postId}/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::post('/posts', [PostController::class, 'store']);
Route::post('/posts/{postId}/comments', [CommentController::class, 'store']);

// Forum Routes - Protected (Update, Delete, Likes)
Route::middleware('auth:sanctum')->group(function () {
    // Posts
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    Route::post('/posts/{id}/like', [PostController::class, 'toggleLike']);

    // Comments
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
    Route::post('/comments/{id}/like', [CommentController::class, 'toggleLike']);
});

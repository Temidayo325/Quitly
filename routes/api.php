<?php

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

Route::post('/register', [App\Http\Controllers\v1\UserController::class, 'register']);
Route::post('/login', [App\Http\Controllers\v1\UserController::class, 'login']);
Route::post('/verifyEmail', [App\Http\Controllers\v1\UserController::class, 'verifyEmail']);
Route::post('/resetPassword', [App\Http\Controllers\v1\UserController::class, 'resetPassword']);

// Wrap everything around here under the auth middleware
Route::post('/changePassword', [App\Http\Controllers\v1\UserController::class, 'changePassword'])->middleware('auth:sanctum');
Route::get('/topics', [App\Http\Controllers\v1\TopicController::class, 'index']);
Route::get('/topics/{id}', [App\Http\Controllers\v1\TopicController::class, 'show']);
Route::post('/topics', [App\Http\Controllers\v1\TopicController::class, 'store']);
Route::patch('/topics', [App\Http\Controllers\v1\TopicController::class, 'update']);
Route::delete('/topics/{id}', [App\Http\Controllers\v1\TopicController::class, 'destroy']);

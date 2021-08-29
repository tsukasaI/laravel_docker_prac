<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::prefix('/users')->group(function () {
    Route::get('/login', [UserController::class, 'authError'])->name('login');
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [UserController::class, 'get']);

        Route::get('/logout', [UserController::class, 'logout']);
    });
});

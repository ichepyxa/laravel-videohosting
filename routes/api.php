<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
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

Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/auth', [AuthController::class, 'auth']);
Route::middleware('auth:sanctum')->group(function () {
  Route::delete('/logout', [AuthController::class, 'logout']);

  Route::get('/profile', [UserController::class, 'profile']);
  Route::patch('/profile', [UserController::class, 'update']);
});
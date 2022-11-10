<?php

use App\Http\Controllers\Web\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
  Route::get('/admin-panel', [AdminController::class, 'videos'])->name('videos');
  Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
  Route::get('/videos/{video}', [AdminController::class, 'showVideo'])->name('show-video');
  Route::get('/videos/{video}/change-status', [AdminController::class, 'changeStatus'])->name('change-status');
  Route::get('/videos/{video}/delete', [AdminController::class, 'delete'])->name('delete');
});
Route::middleware('guest')->group(function () {
  Route::get('/login', [AdminController::class, 'authForm'])->name('login');
  Route::post('/login', [AdminController::class, 'auth'])->name('login-send');
});
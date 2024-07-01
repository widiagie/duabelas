<?php

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

use Inertia\Inertia;
Route::get('/', function () {
   return Inertia::render("Home");
});

require __DIR__.'/auth.php';

use App\Http\Controllers\DashboardController;
// Route::resource('/dashboard','DashboardController')->except(['show']);
// Route::post('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);
// Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('finance.data')->middleware(['auth']);
// Route::get('/dashboard/input', [DashboardController::class, 'input'])->name('finance.input')->middleware(['auth']);
// Route::post('/dashboard/create', [DashboardController::class, 'create'])->name('finance.create')->middleware(['auth']);
// Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('finance.edit')->middleware(['auth']);
// Route::post('/dashboard/update', [DashboardController::class, 'update'])->name('finance.update')->middleware(['auth']);
// Route::delete('/dashboard/destroy/{id}', [DashboardController::class, 'destroy'])->name('finance.destroy')->middleware(['auth']);

use App\Http\Controllers\PostController;
Route::get('/posts', [PostController::class, 'index']);

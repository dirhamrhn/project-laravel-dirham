<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// Halaman Utama (Menampilkan task)
// ==========================================
Route::get('/', [TaskController::class, 'index']);

// ==========================================
// Semua route yang butuh login
// ==========================================
Route::middleware(['auth'])->group(function () {

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Dashboard (default Breeze)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile (default Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================
// Auth routes (login, register, dll)
// ==========================================
require __DIR__.'/auth.php';
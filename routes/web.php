<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Menampilkan halaman utama
Route::get('/', [TaskController::class, 'index'])
    ->name('tasks.index');

// Menambahkan tugas
Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

// Mengubah status tugas
Route::patch('/tasks/{task}', [TaskController::class, 'update'])
    ->name('tasks.update');

// Menghapus tugas
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');
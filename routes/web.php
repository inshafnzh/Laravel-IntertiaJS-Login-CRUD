<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'view'])->name('dashboard');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/add', [StudentController::class, 'showForm'])->name('student.add');
    Route::post('/add', [StudentController::class, 'storeStudent'])->name('student.store');
    Route::delete('/delete/{id}', [StudentController::class, 'deleteStudent'])
    ->name('student.delete');
    Route::get('/edit/{id}', [StudentController::class, 'editStudent'])
    ->name('student.edit');
    Route::put('/update/{id}', [StudentController::class, 'updateStudent'])
    ->name('student.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

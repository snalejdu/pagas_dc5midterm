<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
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


    Route::get('/dashboard', [BookController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/dashboard/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/dashboard/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/dashboard/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/dashboard/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/dashboard/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

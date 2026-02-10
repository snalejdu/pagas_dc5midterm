<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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
   
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'user' => auth()->user() 
        ]);
    })->name('dashboard');

    
    Route::get('/dashboard/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/dashboard/books/create', [BookController::class, 'create'])->name('books.create');  // Route for creating a new book
    Route::post('/dashboard/books', [BookController::class, 'store'])->name('books.store');  // Store the new book

   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/books', [BookController::class, 'index']);

require __DIR__.'/auth.php';

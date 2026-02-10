<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Books', [
            'books' => Book::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/CreateBook');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'published_at' => 'required|date',
        ]);

        Book::create($request->only([
            'title',
            'author',
            'isbn',
            'published_at'
        ]));

        return redirect()->route('books.index');
    }


    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'books' => Book::latest()->get()
        ]);
    }
}

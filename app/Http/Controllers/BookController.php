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

    // Stay on the same page instead of redirecting to books.index
    return redirect()->back();
}

public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'isbn' => 'required|unique:books,isbn,' . $book->id,
        'published_at' => 'required|date',
    ]);

    $book->update($request->only([
        'title',
        'author',
        'isbn',
        'published_at'
    ]));

    return redirect()->back();
}

public function destroy(Book $book)
{
    $book->delete();

    return redirect()->back();
}




    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'books' => Book::latest()->get()
        ]);
    }
}

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
            'books' => Book::all()  // This will pass all books to the frontend
        ]);
    }

    public function create()
    {
        // This method will show the form to create a new book
        return Inertia::render('Dashboard/CreateBook');
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn',  
            'published_at' => 'required|date',  
        ]);

       
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'published_at' => $request->published_at,
        ]);

        
        return redirect()->route('books.index');
    }
}

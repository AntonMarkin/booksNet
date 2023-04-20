<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index($id)
    {
        settype($id, 'integer');
        $user = User::findOrFail($id);
        $books = Book::getUserBooks($id);
        return view('library', compact('user', 'books'));
    }
    public function getBook($id)
    {
        settype($id, 'integer');
        $book = Book::findOrFail($id);
        return view('book', compact('book'));
    }
    public function bookShare(Request $request)
    {
        $valid = $request->validate([
            'book_id' => 'required|integer'
        ]);
        Book::bookShare($valid['book_id']);
        return redirect()->back();
    }
}

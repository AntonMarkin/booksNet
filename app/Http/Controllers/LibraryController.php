<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    /**
     * Show the authorized user library page.
     *
     * @param integer $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        settype($id, 'integer');
        $user = User::findOrFail($id);
        $books = Book::getUserBooks($id);
        return view('library.library', compact('user', 'books'));
    }

    /**
     * Show the book page.
     *
     * @param integer $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBook($id)
    {
        settype($id, 'integer');
        $book = Book::findOrFail($id);
        if (\request()->segment(1) == 'edit-book') {
            $view = 'library.edit_book';
        } elseif (\request()->segment(1) == 'book') {
            $view = 'library.book';
        }
        return view($view, compact('book'));
    }

    /**
     * Delete book by id and redirect on library page.
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function deleteBook($id)
    {
        settype($id, 'integer');
        $userId = Auth::id();
        Book::deleteBook($id, $userId);
        return redirect()->route('library', ['id' => $userId])->with('deleted', 'Книга удалена');
    }

    /**
     * Open or close book for sharing.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function bookShare(Request $request)
    {
        $valid = $request->validate([
            'book_id' => 'required|integer'
        ]);
        Book::bookShare($valid['book_id']);
        return redirect()->back()->with('message', 'Вы открыли книгу по ссылке');
    }

    /**
     * Update or create book.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateOrCreateBook(Request $request)
    {
        $valid = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:50',
            'text' => 'required|max:500',
            'user_id' => 'required|integer'
        ]);
        Book::updateOrCreate(['id' => $valid['id']], $valid);
        return redirect()->route('library', ['id' => Auth::id()])->with('message', 'Книга была добавлена');
    }
}

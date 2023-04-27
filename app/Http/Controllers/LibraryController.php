<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryRequest;
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
     * @param User $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $books = $user->books;
        return view('library.library', compact('user', 'books'));
    }

    /**
     * Show the book page.
     *
     * @param Book $book
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBook(Book $book)
    {
        $view = 'library.book';
        if (\request()->segment(1) == 'edit-book') {
            $view = 'library.edit_book';
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
        $userId = Auth::id();
        Book::deletion($id, $userId);
        return redirect()->route('library', ['user' => $userId])->with('deleted', 'Книга удалена');
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
            'book_id' => 'integer',
        ]);

        $message = 'Вы закрыли книгу по ссылке';
        if (Book::bookShare($valid['book_id'])){
            $message = 'Вы открыли книгу по ссылке';
        }
        return redirect()->back()->with('message', $message);
    }

    /**
     * Update or create book.
     *
     * @param LibraryRequest $request
     * @return RedirectResponse
     */
    public function updateOrCreateBook(LibraryRequest $request)
    {
        $valid = $request->validated();
        Book::updateOrCreate(['id' => $valid['id']], $valid);
        return redirect()->route('library', ['user' => Auth::id()])->with('message', 'Книга была добавлена');
    }
}

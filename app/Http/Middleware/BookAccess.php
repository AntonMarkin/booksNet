<?php

namespace App\Http\Middleware;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bookId = $request->segment(2);
        settype($bookId, 'integer');
        $book = Book::findOrFail($bookId);
        if ($book->share || $book->user_id == Auth::id()) {
            return $next($request);
        }
        return redirect('/')->with('warning', 'У вас нет доступа к этой книге');
    }
}


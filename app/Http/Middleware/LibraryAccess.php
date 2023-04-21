<?php

namespace App\Http\Middleware;

use App\Models\Access;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authorId = $request->segment(2);
        settype($authorId, 'integer');
        if (isset(Access::checkAccess(Auth::id(), $authorId)->access) || $authorId == Auth::id()) {
            return $next($request);
        }
        return redirect('/')->with('warning', 'У вас нет доступа к этой библиотеке');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCommentsController extends Controller
{
    /**
     * Create new record in comments table
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $comments = Comment::getUserComments(Auth::id());
        return view('user_comments', compact('comments'));
    }
}

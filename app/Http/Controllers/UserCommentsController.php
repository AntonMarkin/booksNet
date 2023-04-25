<?php

namespace App\Http\Controllers;

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
        $comments = Auth::user()->comments;
        return view('user_comments', compact('comments'));
    }
}

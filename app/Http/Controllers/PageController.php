<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }
    public function getProfilePage()
    {
        $id = $this->getProfileId();
        $user = User::findOrFail($id);
        $comments = Comment::where('profile_id', $id)->limit(5)->get();
        return view('profile', compact('user', 'comments'));
    }
    public function getAllComments()
    {
        $comments = Comment::where('profile_id', $this->getProfileId())->offset(5)->get();
        return $comments;
    }
    public function getProfileId()
    {
        $id = \request()->segment(2);
        settype($id, 'integer');
        return $id;
    }
}

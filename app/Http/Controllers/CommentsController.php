<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newComment(Request $request)
    {
        $valid = $request->validate([
            'header' => 'required|max:30',
            'text' => 'required|max:200',
            'profile_id' => 'required|integer',
            'comment_id' => 'integer'
        ]);
        $valid['user_id'] = Auth::id();
        Comment::create($valid);
        return redirect()->back();
    }
    public function deleteComment($id)
    {
        settype($id, 'integer');
        $comment = Comment::where('id', $id)->where('status', '!=', 'deleted')->update(['status' => 'deleted']);
        return redirect()->back()->with('message', 'Комментарий удалён');
    }
    
}

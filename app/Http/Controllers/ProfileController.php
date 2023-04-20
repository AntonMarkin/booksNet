<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the application profile page.
     *
     * @param integer $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        settype($id, 'integer');
        $user = User::findOrFail($id);
        $comments = null;
        if ($user) {
            $comments = Comment::getNotDeletedComments($user->id, 5);
        }
        $access = Access::checkAccess($id, Auth::id());
        return view('profile', compact('user', 'comments', 'access'));
    }

    /**
     * Get all the comments via Ajax by skipping the first 5
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function getAllComments($id)
    {
        settype($id, 'integer');
        $user = User::findOrFail($id);
        $comments = null;
        if ($user) {
            $comments = Comment::getNotDeletedComments($user->id, Comment::count(), 5);
        }
        $data = [
            'comments' => view('comments', compact('comments'))->render(),
        ];
        return response()->json($data);
    }

    /**
     * Get comment info and rendering answer form via Ajax
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function getAnswerForm($id)
    {
        settype($id, 'integer');
        $post = Comment::findOrFail($id);
        $data = [
            'answerForm' => view('comment_form', compact('post'))->render(),
        ];
        return response()->json($data);
    }

    /**
     * Create new record in comments table
     * @param Request $request
     * @return RedirectResponse
     */
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

    /**
     * Change comment status to deleted
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function deleteComment($id)
    {
        settype($id, 'integer');
        Comment::deleteComment($id);
        return redirect()->back()->with('message', 'Комментарий удалён');
    }

    public function changeAccess(Request $request)
    {
        $valid = $request->validate([
            'user_id' => 'required|integer'
        ]);
        Access::changeAccess($valid['user_id'], Auth::id());
        return redirect()->back();
    }

}

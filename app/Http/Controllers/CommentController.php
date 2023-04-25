<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Get comment info and rendering answer form via Ajax
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function getAnswerForm(Comment $comment)
    {
        $data = [
            'answerForm' => view('profile.comment_form', compact('comment'))->render(),
        ];
        return response()->json($data);
    }

    /**
     * Create new record in comments table
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function newComment(CommentRequest $request)
    {
        $valid = $request->validated();
        $valid['user_id'] = Auth::id();
        Comment::create($valid);
        return redirect()->back()->with('message', 'Комментарий добавлен');
    }

    /**
     * Change comment status to deleted
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function deleteComment($id)
    {
        Comment::deleteComment($id);
        return redirect()->back()->with('deleted', 'Комментарий удалён');
    }
}

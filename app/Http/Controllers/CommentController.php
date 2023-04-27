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
    public function create(CommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        Comment::create($data);
        return redirect()->back()->with('message', 'Комментарий добавлен');
    }

    /**
     * Change comment status to deleted
     *
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function delete(Comment $comment)
    {
        if ($comment->user_id == Auth::id() || $comment->profile_id == Auth::id()) {
            Comment::deletion($comment);
            return redirect()->back()->with('deleted', 'Комментарий удалён');
        }
        return redirect()->back()->with('warning', 'У вас нет прав на удаление данного комментария');
    }
}

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
     * Show the authorized user profile page.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $comments = null;
        if ($user) {
            $comments = $user->profileComments()->limit(5)->get();
        }
        $access = Access::checkAccess($user->id, Auth::id());
        return view('profile.profile', compact('user', 'comments', 'access'));
    }

    /**
     * Get all the comments via Ajax by skipping the first 5
     *
     * @param User $user
     * @return JsonResponse
     */
    public function comments(User $user)
    {
        $comments = null;
        if ($user) {
            $comments =  $user->profileComments()->limit(Comment::count())->offset(5)->get();
        }
        $data = [
            'comments' => view('profile.comments', compact('comments'))->render(),
        ];
        return response()->json($data);
    }

    /**
     * Changes access to the library of an authorized user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeAccess(Request $request)
    {
        $valid = $request->validate([
            'user_id' => 'required|integer'
        ]);
        $message = 'Вы отключили доступ к библиотеке для этого пользователя';
        if (Access::changeAccess($valid['user_id'], Auth::id())) {
            $message = 'Вы дали  доступ к библиотеке для этого пользователя';
        }
        return redirect()->back()->with('message', $message);
    }

}

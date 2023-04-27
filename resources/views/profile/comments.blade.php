@foreach($comments as $comment)
    <div>
        <div class="card mb-2">
            <div class="card-header">
                <p id="email">{{$comment->user->email}}</p>
            </div>
            <div class="card-body">
                <h5>{{ $comment->header }}</h5>
                <p>{{ $comment->text }}</p>
                @if(isset($comment->comment_id))
                    <hr>
                    <p class="card-text"><small class="text-body-secondary"><b>Ответ на комментарий пользователя: </b>
                            <i>{{ $comment->user->email }} </i>"{{ $comment->header }}"</small></p>
                @endif
            </div>
            @if(Auth::check())
                <div class="card-footer text-body-secondary">
                    @if(request()->path() != 'user/comments')
                        <button onclick="getAnswerForm('{{$comment->id}}')" class="btn btn-outline-dark">Ответить
                        </button>
                    @endif
                    @if(Auth::id() == $comment->profile_id || Auth::id() == $comment->user_id)
                        <a href="{{ route('delete_comment', ['comment' => $comment->id]) }}"
                           class="btn btn-outline-danger delete">Удалить</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div id="answer_{{$comment->id}}"></div>
@endforeach

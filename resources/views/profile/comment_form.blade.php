<form class="comment-form" method="post" action="{{ route('new_comment') }}" >
    @csrf
    <input type="hidden" name="profile_id" @if(isset($user)) value="{{ $user->id }}" @elseif(isset($comment)) value="{{ $comment->profile_id }}" @endif>
    <div class="card mb-2 @if(isset($comment)) border-3 mb @endif">
        <div class="card-header">
            @if(isset($comment->id))
                <p class="card-text"><small class="text-body-secondary"><b>Ответ на комментарий пользователя: </b>
                        <i>{{ $comment->user->email }} </i>"{{ $comment->header }}"</small></p>
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <hr>
            @endif
            <input class="form-control" name="header" required type="text" placeholder="Заголовок">
        </div>
        <div class="card-body">
            <textarea class="form-control" name="text" required placeholder="Текст комментария"></textarea>
        </div>
        <div class="card-footer text-body-secondary">
            <input type="submit" class="btn btn-dark" value="Отправить">
        </div>

    </div>
</form>

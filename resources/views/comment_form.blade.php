<form class="comment-form" method="post" action="{{ route('new_comment') }}" >
    @csrf
    <input type="hidden" name="profile_id" @if(isset($user)) value="{{ $user->id }}" @elseif(isset($post)) value="{{ $post->profile_id }}" @endif>
    <div class="card mb-2 @if(isset($post)) border-3 mb @endif">
        <div class="card-header">
            @if(isset($post->id))
                <p class="card-text"><small class="text-body-secondary"><b>Ответ на комментарий пользователя: </b>
                        <i>{{ $post->user->email }} </i>"{{ $post->header }}"</small></p>
                <input type="hidden" name="comment_id" value="{{ $post->id }}">
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

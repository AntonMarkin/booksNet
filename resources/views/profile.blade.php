@extends('layouts.app')

@section('title', '')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $user->email }}</p>
            <hr class="featurette-divider">

            <h2>Комментарии:</h2>
            @if(Auth::check())
                <h3>Новый коментарий</h3>
                <form method="post" action="{{ route('new_comment') }}">
                    @include('comment_form')
                </form>
            @endif
            <hr>
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
                                <p class="card-text"><small class="text-body-secondary"><b>Ответ на комментарий: </b>{{ $comment->comment->text }}</small></p>
                        </div>
                            @endif
                        </div>
                        @if(Auth::check())
                            <div class="card-footer text-body-secondary">
                                <a href="#" class="btn btn-outline-dark">Ответить</a>

                                @if(Auth::id() == $comment->profile_id || Auth::id() == $comment->user_id)
                                    <a href="{{ route('delete_comment', ['id' => $comment->id]) }}" class="btn btn-outline-danger">Удалить</a>
                                @endif
                            </div>
                        <!-- тут отправка данных через ажакс и появление формы ответа на коммент
                <form method="post" action="{{ route('new_comment') }}">
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        include('comment_form')
</form>-->

                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

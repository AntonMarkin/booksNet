@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $user->email }}</p>
            @if(Auth::check() && $user->id != Auth::id())
                <div class="mb-2 row">
                    <form method="post" action="{{ route('change_access') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        @if(!isset($access->access))
                            <input type="submit" class="btn btn-outline-primary col-sm-4" value="Дать доступ к библиотеке">
                        @elseif($access->access == true)
                            <input type="submit" class="btn btn-outline-warning col-sm-4" value="Отключить доступ к библиотеке">
                        @endif
                        <a class="col-sm-3 btn btn-outline-dark ms-2" href="{{ route('library', ['id', $user->id]) }}">Перейти к библиотеке</a>
                    </form>

                </div>
            @endif
            <hr class="featurette-divider">

            <h2>Комментарии:</h2>
            @if(Auth::check())
                <h3>Новый коментарий</h3>
                @include('profile.comment_form')
            @endif
            <hr>
            @include('profile.comments')
            <button class="btn btn-link" id="get-all">Показать все комментарии</button>
            <div id="comments"></div>
        </div>
        <script>
            $(document).on('click', '#get-all', function () {
                $('#get-all').hide();
                $.ajax({
                    url: "/profile/{{ request()->segment(2) }}/all",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#comments').append(data.comments)
                    }
                });
            });

            function getAnswerForm(id) {
                $.ajax({
                    url: "/comment/" + id + "/answer",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#answer_' + id).append(data.answerForm)
                    }
                });
            }
        </script>
@endsection

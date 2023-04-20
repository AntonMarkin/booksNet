@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $user->email }}</p>
            <hr class="featurette-divider">

            <h2>Комментарии:</h2>
            @if(Auth::check())
                <h3>Новый коментарий</h3>
                @include('comment_form')
            @endif
            <hr>
            @include('comments')
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

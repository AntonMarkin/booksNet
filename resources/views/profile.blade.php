@extends('layouts.app')

@section('title', '')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $user->email }}</p>
            <hr class="featurette-divider">
            <h2>Комментарии:</h2>
            @foreach($comments as $comment)

                <div class="card">
                    <div class="card-header">
                        {{ $comment->header }}
                    </div>
                    <div class="card-body">
                        <p>{{ $comment->text }}</p>
                    </div>
                    <a href="#" class="btn btn-dark">Ответить</a>
                </div>
            @endforeach
            @include('comment_form')
        </div>
    </div>
@endsection

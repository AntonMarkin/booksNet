@extends('layouts.app')

@section('title', 'Comments')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <hr class="featurette-divider">
            <h2>Комментарии пользователя <b>{{ Auth::user()->email }}</b>:</h2>
            @include('profile.comments')
        </div>
    </div>

@endsection

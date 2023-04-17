@extends('layouts.app')

@section('title', '')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($users as $user)
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{$user->email}}</h5>
                        <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-primary">Смотреть профиль</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

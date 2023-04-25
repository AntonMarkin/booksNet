@extends('layouts.app')

@section('title', '')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                <h2>Профили пользователей</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($users as $user)
                        <div class="col">
                            <div class="card mt-2 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{$user->email}}</h5>
                                    <a href="{{ route('profile', ['user' => $user->id]) }}" class="btn btn-outline-dark">Смотреть
                                        профиль</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
@endsection

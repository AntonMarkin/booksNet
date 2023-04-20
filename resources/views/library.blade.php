@extends('layouts.app')

@section('title', 'Library')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $user->email }}</p>
            <hr class="featurette-divider">

            <hr class="featurette-divider">
            <h5>Список книг:</h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Действия</th>
                    <th scope="col">Ссылка</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->name }}</td>
                        <td><a href="{{ route('get_book', ['id' => $book->id]) }}" class="btn btn-outline-dark">Перейти к книге</a></td>
                        <form method="post" action="{{ route('book_share') }}">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                        @if($book->share)
                            <td><input type="submit" class="btn btn-outline-warning" value="Закрыть доступ по ссылке">
                                <input type="text" class="form-control" readonly value="{{ route('get_book', ['id' => $book->id]) }}"></td>
                        @else
                            <td><input type="submit" class="btn btn-outline-primary" value="Поделиться книгой по ссылке"></td>
                        @endif
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

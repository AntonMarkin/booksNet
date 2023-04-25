@extends('layouts.app')

@section('title', 'Library')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $user->email }}</p>
            <hr class="featurette-divider">
            @include('library.book_form')
            <hr class="featurette-divider">
            <h5>Список книг:</h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Редактировать</th>
                    <th scope="col">Ссылка</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->name }}</td>
                        <td><a href="{{ route('get_book', ['book' => $book->id]) }}" class="btn btn-outline-dark">Перейти к книге</a></td>
                        <form method="post" action="{{ route('book_share') }}">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                        @if($book->share)
                            <td class="row"><input type="submit" class="btn btn-outline-warning col-sm-4" value="Закрыть доступ по ссылке">
                                <input type="text" class="mx-2 form-control col-sm" readonly value="{{ route('get_book', ['book' => $book->id]) }}"></td>
                        @else
                            <td class="row"><input type="submit" class="btn btn-outline-primary col-sm-4" value="Поделиться книгой по ссылке"></td>
                        @endif
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

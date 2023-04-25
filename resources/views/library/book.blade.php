@extends('layouts.app')

@section('title', $book->name)

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $book->name }}</p>
            <hr class="featurette-divider">
            <form method="post" action="{{ route('book_share') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                @if($book->share)
                    <div class="row mb-3"><input type="submit" class="btn btn-outline-warning col-sm-4"
                                                 value="Закрыть доступ по ссылке">
                        <input type="text" class="ms-2 form-control col-sm" readonly
                               value="{{ route('get_book', ['book' => $book->id]) }}"></div>
                @else
                    <div class="row mb-3"><input type="submit" class="btn btn-outline-primary col-sm-4"
                                                 value="Поделиться книгой по ссылке"></div>
                @endif
            </form>
            <a class="col-sm btn btn-dark me-2 mb-2" href="{{ route('edit_book', ['id' => $book->id]) }}">Редактировать книгу</a>
            <a class="col-sm btn btn-danger ms-2 mb-2" href="{{ route('delete_book', ['id' => $book->id]) }}">Удалить книгу</a>

            <hr class="featurette-divider">
            <textarea class="form-control" readonly>{{ $book->text }}</textarea>
        </div>
    </div>

@endsection

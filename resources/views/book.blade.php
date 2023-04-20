@extends('layouts.app')

@section('title', $book->name)

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <p>{{ $book->name }}</p>
            <hr class="featurette-divider">
            <textarea class="form-control" readonly>{{ $book->text }}</textarea>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>
        <p>Autor: {{ $book->author }}</p>
        <p>Ano de Publicação: {{ $book->year_published }}</p>
        <p>ISBN: {{ $book->isbn }}</p>
{{--        <a href="{{ route('client.reserve.form', $book) }}" class="btn btn-primary">Reservar Livro</a>--}}
    </div>
@endsection

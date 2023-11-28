@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservar Livro: {{ $book->title }}</h1>
        <form method="post" action="{{ route('client.reserve', $book ) }}">
            @csrf
            <button type="submit" class="btn btn-dark">Confirmar Reserva</button>
        </form>
    </div>
@endsection
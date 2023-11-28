@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Detalhes do livro -->
        <h1>{{ $book->title }}</h1>
        <p>Autor: {{ $book->author }}</p>
        <p>Ano de Publicação: {{ $book->year_published }}</p>
        <p>ISBN: {{ $book->isbn }}</p>
        <p>Quantidade: {{ $book->quantity }}</p>

        <!-- Exibir Mensagens de Sucesso ou Erro -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <a href="{{ route('client.reserve.form', $book) }}" class="btn btn-primary">Reservar Livro</a>
    </div>
@endsection

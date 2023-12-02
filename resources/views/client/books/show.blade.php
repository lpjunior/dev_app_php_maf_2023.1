@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Book</li>
            </ol>
        </nav>
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
        @if($book->quantity <= 0)
        <a href="{{ route('client.reserve.form', $book) }}" class="btn btn-dark">Reservar Livro</a>
        @endif
        @if($book->quantity > 0)
        <a href="{{ route('client.loan.form', $book) }}" class="btn btn-dark">Empréstimo Livro</a>
        @endif
        <a href="{{ url()->previous() }}" class="link-dark">Voltar</a>
    </div>
@endsection

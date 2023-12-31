@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('client.books.show', $book) }}">Book</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reserve</li>
            </ol>
        </nav>
        <h1>Reservar Livro: {{ $book->title }}</h1>
        <form method="post" action="{{ route('client.reserve', $book ) }}">
            @csrf
            <button type="submit" class="btn btn-dark">Confirmar Reserva</button>
            <a href="{{ url()->previous() }}" class="link-dark">Voltar</a>
        </form>
        <!-- Exibir Mensagens de Sucesso ou Erro -->
        <div class="my-3">
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
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Books</a></li>
                <li class="breadcrumb-item"><a href="{{ route('client.books.show', $book) }}">Book</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loan</li>
            </ol>
        </nav>
        <h1>Empréstimo Livro: {{ $book->title }}</h1>
        <form method="post" action="{{ route('client.loan', $book ) }}">
            @csrf
            <button type="submit" class="btn btn-dark">Confirmar Empréstimo</button>
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
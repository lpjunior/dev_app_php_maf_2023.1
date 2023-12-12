@extends('layouts.app')
<style>
    .card {
        flex: 1 0 200px !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    .card-img-top {
        width: auto !important;
        height: 300px !important;
        object-fit: cover !important;
    }

    .card-title {
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        max-width: 200px !important;
    }

    .book-card {
        margin-bottom: 20px !important;
    }

    @media screen and (max-width: 768px) {
        .book-card {
            max-width: 33.33% !important;
        }
    }
</style>
@section('content')
    <div class="container">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Books</li>
            </ol>
        </nav>
        <h1>Livros Disponíveis</h1>
        <div class="row">
            @foreach ($books as $book)
            <div class="col-md-2 col-sm-4 col-xs-12 book-card">
                <div class="card">
                    <img class="card-img-top" src="{{ $book->cover_url }}" alt="{{ $book->cover_url }}" />
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">Autor: {{ $book->author }}</p>
                    <p class="card-text">Ano de Publicação: {{ $book->year_published }}</p>
                    <p class="card-text">ISBN: {{ $book->isbn }}</p>
                    <p class="card-text">Quantidade: <span class="{{ $book->quantity <= 0 ? 'text-danger' : 'text-success' }}">{{ $book->quantity }}</span></p>
                    <a href="{{ route('client.books.show', $book) }}" class="btn btn-dark">Ver Detalhes</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

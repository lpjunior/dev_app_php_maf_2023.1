@extends('layouts.app')

<style>
    .reviews-section {
        margin-top: 2rem;
    }
    
    .reviews-section h3 {
        margin-bottom: 1rem;
    }

    .reviews-section .review-item {
        border-left: 4px solid #f5eb3b;
        background-color: #f5f6f7;
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 0.25rem;
    }

    .reviews-section .review-item p {
        margin-bottom: 0.5rem;
    }

    .reviews-section .rating-stars {
        color: #f5eb3b;
        margin-right: 0.5rem;
    }

    .reviews-section .rating-stars .fa-star {
        margin-right: 0.25rem;
    }

    .reviews-section .review-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .reviews-section .review-author {
        font-weight: bold;
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }

    .reviews-section .review-date {
        text-align: right;
        font-size: 0.85rem;
        color: #666;
    }
</style>

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
            </ol>
        </nav>

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

        <div class="row">
            <div class="col-md-8">
                <!-- Detalhes do livro -->
                <h2 class="display-4">{{ $book->title }}</h2>
                <p class="text-muted">Autor: {{ $book->author }}</p>
                <p>Ano de Publicação: <span class="text-secondary">{{ $book->year_published }}</span></p>
                <p>ISBN: <span class="text-secondary">{{ $book->isbn }}</span></p>
                <p>Quantidade: <span class="{{ $book->quantity <= 0 ? 'text-danger' : 'text-success' }}">{{ $book->quantity }}</span></p>
            </div>
            <div class="col-md-4 text-md-right">
                @if($book->quantity <= 0)
                <a href="{{ route('client.reserve.form', $book) }}" class="btn btn-dark">Reservar Livro</a>
                @endif
                @if($book->quantity > 0)
                <a href="{{ route('client.loan.form', $book) }}" class="btn btn-dark">Pegar Empréstimo</a>
                @endif
            </div>
        </div>

        <div class="reviews-section">
            <h3>avaliações</h3>
            @if($book->reviews->isEmpty())
                <p class="text-muted">Não existem avaliações para este livro ainda.</p>
            @else
                <div class="list-group">
                @foreach($book->reviews as $review)
                    <div class="review-item">
                        <div class="review-meta">
                            <h5 class="review-author">Avaliado por {{ $review->user->name }}</h5>
                            <small class="review-date">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                        <p>{{ $review->comment }}</p>
                        <div class="rating-stars">
                            @for($i = 0; $i < $review->rating; $i++)
                                <span class="fa fa-star"></span>
                            @endfor
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
        <!-- Botões de navegação -->
        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="link-dark">Voltar</a>
        </div>
    </div>
@endsection

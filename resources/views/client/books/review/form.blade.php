@extends('layouts.app')

<style>
    .start-rating {
        direction: rtl;
        font-size: 0; /* Remove o espaço entre os elementos inline-block */
        text-align: left;
    }

    .start-rating input[type="radio"] {
        display: none; /* Esconde os inputs radio */
    }

    .start-rating label {
        font-size: 2rem; /* Tamanho das estrelas */
        color: #ddd; /* Cor das estrelas quando não selecionadas */
        cursor: pointer;
        display: inline-block; /* Faz com que as labels se comportem como inline-block */
        margin: 0;
    }

    .start-rating label::before {
        content: '\2605'; /* Código Unicode para a estrela preta */
    }

    .start-rating label:hover 
    .start-rating label:hover ~ label,
    .start-rating input[type="radio"]:checked ~ label {
        color: #f5eb3b;
    }
</style>

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('client.books.index') }}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <h1>Avaliação: {{ $book->title }}</h1>
    <form method="post" action="{{ route('books.reviews.store', $book) }}">
        @csrf

        <div class="mb-3 row">
            <label for="inputComment" class="form-label">Comentário</label>
            <div class="col-sm-4">
                <textarea class="form-control @error('comment') is-invalid @enderror" id="inputComment" name="comment" aria-describedby="commentHelp">{{ old('comment') }}</textarea>
                <div id="commentHelp" class="form-text">O comentário é obrigatório.</div>
                @error('comment')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="form-label">Avaliação</label>
            <div class="start-rating">
                @for($i = 5; $i >= 1; $i--)
                    <input type="radio" id="start-{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} />
                    <label for="start-{{ $i }}" title="{{ $i }} estrelas"></label>
                @endfor
            </div>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">Cadastrar</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-link">Cancelar</a>
    </form>
</div>
@endsection

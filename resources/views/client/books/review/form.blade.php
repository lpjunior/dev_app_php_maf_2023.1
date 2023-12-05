@extends('layouts.app')

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

        <div class="mb-3">
            <label for="inputComment" class="form-label">Comentário</label>
            <textarea class="form-control @error('comment') is-invalid @enderror" id="inputComment" name="comment" aria-describedby="commentHelp">{{ old('comment') }}</textarea>
            <div id="commentHelp" class="form-text">O comentário é obrigatório.</div>
            @error('comment')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputRating" class="form-label">Avaliação</label>
            <input type="number" class="form-control @error('rating') is-invalid @enderror" id="inputRating" name="rating" value="{{ old('rating') }}" aria-describedby="ratingHelp">
            <div id="ratingHelp" class="form-text">A avalição deve ser entre 1 e 5.</div>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">Cadastrar</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-link">Cancelar</a>
    </form>
</div>
@endsection

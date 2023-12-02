@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.books.index') }}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <h1>Editar Livro: {{ $book->title }}</h1>
    <form method="post" action="{{ route('admin.books.edit', $book) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="inputTitle" class="form-label">Título</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle" name="title" value="{{ old('title', $book->title) }}" aria-describedby="titleHelp">
            <div id="titleHelp" class="form-text">O título deve ter entre 3 e 255 caracteres.</div>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputAuthor" class="form-label">Autor</label>
            <input type="text" class="form-control @error('author') is-invalid @enderror" id="inputAuthor" name="author" value="{{ old('author', $book->author) }}" aria-describedby="authorHelp">
            <div id="authorHelp" class="form-text">O autor deve ter entre 3 e 100 caracteres.</div>
            @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputIsbn" class="form-label">ISBN</label>
            <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="inputIsbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" aria-describedby="isbnHelp">
            <div id="isbnHelp" class="form-text">O ISBN deve seguir o padrão internacional.</div>
            @error('isbn')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputYearPublished" class="form-label">Ano de Publicação</label>
            <input type="number" class="form-control @error('year_published') is-invalid @enderror" id="inputYearPublished" name="year_published" value="{{ old('year_published', $book->year_published) }}" aria-describedby="yearPublishedHelp">
            <div id="yearPublishedHelp" class="form-text">O ano de publicação não pode ser no futuro.</div>
            @error('year_published')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputQuantity" class="form-label">Quantidade</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="inputQuantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" aria-describedby="quantityHelp">
            <div id="quantityHelp" class="form-text">A quantidade deve ser entre 0 e 5.</div>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">Atualizar</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-link">Cancelar</a>
    </form>
</div>
@endsection

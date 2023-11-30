@extends('layouts.app')

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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->author }}</p>
                            <a href="{{ route('client.books.show', $book) }}" class="btn btn-primary">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

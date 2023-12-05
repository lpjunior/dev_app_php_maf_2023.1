@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Livros mais Emprestados</h1>
    @if($books->isEmpty())
    <p>Não existem empréstimos ainda.</p>
    @else
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Título</th>
                <th>Quantidade de Empréstimos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->loans_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
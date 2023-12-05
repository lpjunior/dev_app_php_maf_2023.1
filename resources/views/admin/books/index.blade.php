@extends('layouts.app')

<style>
    .table td {
        text-align: left !important;
        vertical-align: middle !important;
        padding: 8px !important;
    }
</style>
@section('content')
    <div class="container">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Books</li>
            </ol>
        </nav>
        <h1>Livros</h1>
        <a href="{{ route('admin.books.create') }}">Adicionar um novo livro</a>
        <table class="table table-striped table-hover">
            <thead>
                <th>Titulo</th>
                <th>ISBN</th>
                <th >Quantidade</th>
                <th>Editar</th>
                <th>Excluir</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td><a href="{{ route('admin.books.edit', $book) }}">Editar <i class="fa-solid fa-pencil"></i></a></td>
                    <td>
                    <form id="delete-form-{{ $book->id }}" method="post" action="{{ route('admin.books.delete', $book ) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a class="btn btn-link" href="#" onclick="confirmDeletion('{{ $book->id }}')">Excluir <i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDeletion(bookId) {
            if(confirm('Tem certeza que deseja excluir este livro?'))
            {
                document.getElementById('delete-form-' + bookId).submit();
            }
        }
    </script>
@endsection

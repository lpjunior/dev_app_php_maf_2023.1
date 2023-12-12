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
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
        <h1>Livros</h1>
        <a href="{{ route('admin.users.create') }}">Adicionar um novo usuário</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th >Perfil</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->type }}</td>
                    <td><a href="{{ route('admin.users.edit', $user) }}">Editar <i class="fa-solid fa-pencil"></i></a></td>
                    <td>
                    <form id="delete-form-{{ $user->id }}" method="post" action="{{ route('admin.users.delete', $user ) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a class="btn btn-link" href="#" onclick="confirmDeletion('{{ $user->id }}')">Excluir <i class="fa-solid fa-trash"></i></a>
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

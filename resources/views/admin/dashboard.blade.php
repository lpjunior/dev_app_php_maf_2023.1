@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    Profile
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#">Editar Perfil</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    Livros
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="books">Listar Livros</a></li>
                    <li class="list-group-item"><a href="books/create">Cadastrar Livro</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    Usuários
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="users">Listar Usuários</a></li>
                    <li class="list-group-item"><a href="users/create">Cadastrar Usuário</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">
                    Relatório
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="/admin/reports/most-borrowed-books">Top 10 Livros</a></li>
                    <li class="list-group-item"><a href="/admin/reports/most-active-users">Top 10 Usuários</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
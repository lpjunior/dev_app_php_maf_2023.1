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
                    <li class="list-group-item"><a href="client/loans">Visualizar Empréstimos</a></li>
                    <li class="list-group-item"><a href="client/reservations">Visualizar Reservas</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    Livros
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="/">Livros</a></li>
                <li class="list-group-item"><a href="#">Consultar Livro</a></li>
                <li class="list-group-item"><a href="#">Avaliações</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
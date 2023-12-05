@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Usuários mais ativos</h1>
    @if($users->isEmpty())
    <p>Não existem empréstimos ainda.</p>
    @else
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade de Empréstimos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->loans_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
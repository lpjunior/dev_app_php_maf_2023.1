@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loans</li>
            </ol>
        </nav>
        <h1>Meus Empréstimos</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <ul class="list-group">
            @forelse ($loans as $loan)
                <li class="list-group-item">
                    <h5 class="mb-1">Livro: {{ $loan->book->title }}</h5>
                    <p class="mb-1">Data empréstimo: {{ date('d/m/Y', strtotime($loan->loan_date)) }}</p>
                    <p class="mb-1">Data de Devolução Prevista: {{ date('d/m/Y', strtotime($loan->return_date)) }}</p>
                    @if(!$loan->returned)
                    <form method="post" action="{{ route('client.returnLoan', $loan->id ) }}">
                        @csrf
                        <button type="submit" class="btn btn-dark">Devolver Livro</button>
                    </form>
                    @else
                        <span class="text text-success">Devolvido</span>
                    @endif
                </li>
            @empty
                <p>Você não possue reservas no momento.</p>
            @endforelse
        </ul>
    </div>
@endsection
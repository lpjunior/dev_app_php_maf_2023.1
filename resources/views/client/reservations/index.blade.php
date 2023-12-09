@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reservations</li>
            </ol>
        </nav>
        <h1>Minhas Reservas</h1>
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
            @forelse ($reservations as $reservation)
                <li class="list-group-item">
                    <p class="mb-1"><strong>Livro:</strong> {{ $reservation->book->title }}</p>
                    <p class="mb-1"><strong>Data Reserva:</strong> {{ date('d/m/Y H:i:s', strtotime($reservation->reservation_date)) }}</p>
                    <p class="mb-1"><strong>Status:</strong> {{ $reservation->status }}</p>
                </li>
            @empty
                <p>Você não possue reservas no momento.</p>
            @endforelse
        </ul>
    </div>
@endsection

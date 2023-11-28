@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Minhas Reservas</h1>
        <ul class="list-group">
            @foreach ($reservations as $reservation)
                <li class="list-group-item">
                    Livro: {{ $reservation->book->title }}
                    Data Reserva: {{ $reservation->reservation_date }}
                    Status: {{ $reservation->book->status }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection

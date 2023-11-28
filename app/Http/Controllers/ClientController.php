<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReservationType;
use App\Models\Reservation;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    /**
    * Exibir uma lista de todos os livros
    */
    public function index()
    {
        $books = Book::all();
        return view('client.books.index', compact('books'));
    }

    /**
    * Exibir um livro especifico
    */
    public function show(Book $book)
    {
        return view('client.books.show', compact('book'));
    }

    /**
    * Mostrar formulário para fazer uma reserva
    */
    public function showReservationForm(Book $book)
    {
        if ($book->quantidade == 0) {
            return view('client.books.reserve.form', compact('book'));
        }
        return redirect()->back()->with('error', 'Livro disponível para empréstimo.');
    }

    /**
     * Realizar uma reserva
     *
     * @param Request $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function reserve(Request $request, Book $book)
    {
        if($book->quantity <= 0) {
            $reservation = new Reservation();
            $reservation->user_id = Auth::id();
            $reservation->book_id = $book->id;
            $reservation->reservation_date = now();
            $reservation->status = ReservationType::ACTIVE;
            $reservation->expiration_date = now()->addDays(2);
            $reservation->save();

            print("teste");

            return redirect()->route('client.reservations')->with('success','Reserva realizada com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Este livro está disponível e não pode ser reservado.');
        }
    }

    /**
     * Exibir reservas do usuário
     */
    public function reservations()
    {
        $reservations = Auth::user()->reservations;
        return view('client.reservations.index', compact('reservations'));
    }
}

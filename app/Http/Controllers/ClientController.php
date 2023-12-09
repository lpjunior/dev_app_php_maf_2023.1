<?php

namespace App\Http\Controllers;

use App\Mail\BookAvailableMail;
use App\Models\Book;
use App\Models\Loan;
use App\Models\ReservationType;
use App\Models\Reservation;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mail;

class ClientController extends Controller
{
    /**
     * Exibe o painel de controle do cliente
    */
    public function dashboard()
    {
        return view('client.dashboard');
    }

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
        if ($book->quantity == 0) {
            return view('client.books.reserve.form', compact('book'));
        }

        return redirect()->back()->with('error', 'Livro disponível para reserva.');
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
        $user = auth()->user();

        if(!$user->canReserveBook()) {
            return redirect()->back()->with('error', "Você não pode efetuar reservas até {$user->reservation_ban_until->format('d/m/Y')}.");
        }

        if($book->quantity <= 0) {
            $reservation = new Reservation();
            $reservation->user_id = Auth::id();
            $reservation->book_id = $book->id;
            $reservation->reservation_date = now();
            $reservation->status = ReservationType::ACTIVE->value;
            $reservation->expiration_date = null;
            $reservation->save();

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

    /**
    * Mostrar formulário para fazer um emprestimo
    */
    public function showLoanForm(Book $book)
    {
        if ($book->quantity <= 0) {
            return back()->with('error', 'Livro não está disponível para empréstimo.');
        }

        return view('client.books.loan.form', compact('book'));
    }

     /**
     * Realizar uma reserva
     *
     * @param Request $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function loan(Request $request, Book $book)
    {
        $user = auth()->user();

        if($book->quantity <= 0) {
            return redirect()->back()->with('error', 'Este livro está indisponível e não pode ser emprestado.');
        }
        
        $reservation = Reservation::where('user_id', $user->id)
                                  ->where('book_id', $book->id)
                                  ->where(function($query){
                                        $query->where('status', ReservationType::ACTIVE->value)
                                              ->orWhere('status', ReservationType::EXPIRED->value);
                                    })
                                  ->first();

        if($reservation && now()->gt($reservation->expiration_date))
        {
            $user->incrementFailedReservations();
            
            $reservation->status = ReservationType::EXPIRED->value;
            $reservation->save();

            return redirect()->route('client.loans')->with('error','Sua reserva está expirada.');
        }

        $loan = new Loan();
        $loan->user_id = $user->id;
        $loan->book_id = $book->id;
        $loan->loan_date = now();
        $loan->return_date = now()->addDays(7);
        $loan->save();

        // Atualiza a quantidade do livro
        $book->decrement('quantity');

        if($reservation)
        {
            // Finaliza a reserva
            $reservation->expiration_date = null;
            $reservation->status = ReservationType::COMPLETED->value;
            $reservation->save();

            // Envia um e-mail de notificação

        }                   
        return redirect()->route('client.loans')->with('success','Empréstimo realizado com sucesso.');
    }

    /**
     * Exibir empréstimos do usuário
     */
    public function loans()
    {
        $loans = Auth::user()->loans;
        return view('client.loans.index', compact('loans'));
    }

    /**
     * Devolver um livro emprestado
     */
    public function returnLoan(Request $request, $loanId)
    {
        $loan = Loan::where('id', $loanId)->where('user_id', Auth::id())->firstOrFail();

        if(!$loan) 
        {
            return redirect()->back()->with('error','Empréstimo não encontrado ou não corresponde ao usuário');
        }

        if($loan->returned) 
        {
            return redirect()->back()->with('error','Este livro já foi devolvido');
        }

        $loan->returned = true;
        $loan->return_date = now();
        $loan->save();

        // Atualiza a quantidade do livro
        $loan->book->increment('quantity');

        // Verifica se existem reservas pendentes para o livro
        $reservation = Reservation::where('book_id', $loan->book_id)
        ->where('status', ReservationType::ACTIVE->value)
        ->first();

        if($reservation)
        {
            // Defini a data de expiração para 48h
            $reservation->expiration_date = now()->addDays(2);
            $reservation->save();

            // Envia um e-mail de notificação
            $book = Book::where('id', $loan->book_id)->first();
            $user = User::where('id', $loan->user_id)->first();
            Mail::to($user)->send(new BookAvailableMail($user, $book));
        }

        return redirect()->route('client.loans')->with('success','Livro devolvido com sucesso.');
    }
}

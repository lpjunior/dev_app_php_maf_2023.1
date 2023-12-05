<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function mostBorrowedBooks()
    {
        $books = Book::withCount('loans')
                     ->having('loans_count', '>', 0)
                     ->orderBy('loans_count', 'desc')
                     ->take(10)
                     ->get();

        /**
         * withCount('loans') adiciona uma propriedade 'loans_count' a cada item
         * having('loans_count', '>', 0) filtra os itens que não tem empréstimo
         * orderBy('loans_count', 'desc') organiza os resultados para que os itens com mais empréstismos apareçam primeiro.
         * take(10) Limita a 10 livros para exibição
        */
        return view('admin.reports.most-borrowed-books', compact('books'));
    }

    public function mostActiveUsers()
    {
        $users = User::withCount('loans')
        ->having('loans_count', '>', 0)
        ->orderBy('loans_count', 'desc')
        ->take(10)
        ->get();

        return view('admin.reports.most-active-users', compact('users'));
    }
}

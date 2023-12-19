<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id; // Ou outra forma de obter o ID do usuário autenticado

        // Obter empréstimos com detalhes do livro
        $loans = Loan::with('book') // 'book' é o nome da relação no modelo Loan
        ->where('user_id', $userId)
            ->get();

        // Obter reservas com detalhes do livro
        $reservations = Reservation::with('book') // 'book' é o nome da relação no modelo Reservation
        ->where('user_id', $userId)
            ->get();

        // Combine e ordene as coleções (ajuste a lógica conforme necessário)
        $history = $loans->merge($reservations)->sortByDesc('created_at');

        // Paginação manual (ajuste conforme necessário)
        $perPage = 10;
        $page = Paginator::resolveCurrentPage() ?: 1;
        $items = $history->forPage($page, $perPage);
        $paginatedItems = new LengthAwarePaginator($items, $history->count(), $perPage, $page);

        return response()->json($paginatedItems);
    }
}

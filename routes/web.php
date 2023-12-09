<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
*/
Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| Rotas da Página Inicial
|--------------------------------------------------------------------------
*/

Route::get('/', [ClientController::class,'index'])->name('client.books.index');

/*
|--------------------------------------------------------------------------
| Rotas Abertas
|--------------------------------------------------------------------------
*/

// Detalhes do livro
Route::get('/books/{book}', [ClientController::class,'show'])->name('client.books.show');

/*
|--------------------------------------------------------------------------
| Rotas de Usuários
|--------------------------------------------------------------------------
*/

// Página Principal
Route::get('/home', [HomeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Rotas do Cliente
|--------------------------------------------------------------------------
*/

Route::middleware(['verified', 'client'])->group(function() {    
    // Dashboard Admin
    Route::get('/client/dashboard', [ClientController::class,'dashboard'])->name('client.dashboard');

    // Formulário para fazer reserva
    Route::get('/books/{book}/reserve', [ClientController::class,'showReservationForm'])->name('client.reserve.form');
    
    // Enviar reserva
    Route::post('/books/{book}/reserve', [ClientController::class,'reserve'])->name('client.reserve');
    
    // Listagem de reservas
    Route::get('/client/reservations', [ClientController::class,'reservations'])->name('client.reservations');

    // Formulário para fazer empréstimo
    Route::get('/books/{book}/loan', [ClientController::class,'showLoanForm'])->name('client.loan.form');
    
    // Enviar empréstimo
    Route::post('/books/{book}/loan', [ClientController::class,'loan'])->name('client.loan');

    // devolver empréstimo
    Route::post('/client/return-loan/{loan}', [ClientController::class,'returnLoan'])->name('client.returnLoan');
    
    // Listagem de empréstimos
    Route::get('/client/loans', [ClientController::class,'loans'])->name('client.loans');

    // Formulário para fazer avaliação
    Route::get('/books/{book}/reviews', [ReviewController::class,'review'])->name('books.review.form');
    // Enviar avaliação
    Route::post('/books/{book}/reviews', [ReviewController::class,'store'])->name('books.reviews.store');
});

/*
|--------------------------------------------------------------------------
| Rotas do Administrador
|--------------------------------------------------------------------------
*/
Route::middleware(['verified', 'admin'])->group(function() {    
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    // Listar todos os livros
    Route::get('/admin/books', [BookController::class,'index'])->name('admin.books.index');
    
    // Formulário para criar um novo livro
    Route::get('/admin/books/create', [BookController::class,'create'])->name('admin.books.create');
    
    // Enviar novo livro
    Route::post('/admin/books/create', [BookController::class,'store'])->name('admin.books.create');    
    
    // Formulário para editar livro
    Route::get('/admin/books/edit/{book}', [BookController::class, 'edit'])->name('admin.books.edit');

    // Enviar livro editado
    Route::put('/admin/books/edit/{book}', [BookController::class,'update'])->name('admin.books.edit');

    // Enviar exclusão do livro
    Route::delete('/admin/books/{book}', [BookController::class,'delete'])->name('admin.books.delete');

    // Exibir Relatório de livros mais emprestados
    Route::get('/admin/reports/most-borrowed-books', [ReportController::class, 'mostBorrowedBooks'])->name('admin.reports.most-borrowed-books');

    // Exibir Relatório de usuários mais ativos
    Route::get('/admin/reports/most-active-users', [ReportController::class, 'mostActiveUsers'])->name('admin.reports.most-active-users');
});
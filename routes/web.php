<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
*/
Auth::routes();

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Rotas do Cliente
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth']], function () {
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
});

/*
|--------------------------------------------------------------------------
| Rotas do Administrador
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function () {
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
});
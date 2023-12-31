<?php

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ReportController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\UserController;
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

Route::middleware(['verified', 'client'])->group(callback: function () {
    // Dashboard Admin
    Route::get('/client/dashboard', [ClientController::class,'dashboard'])->name('client.dashboard');

    // Formulário para editar perfil
    Route::get('/client/perfil/{user}', [ClientController::class, 'editPerfil'])->name('client.perfil.edit');

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
Route::middleware(['verified', 'admin'])->group(function () {

    ###Rota da home do admin

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');

    ###Rotas de perfil

    // Formulário para editar perfil
    Route::get('/admin/perfil/{user}', [AdminController::class, 'edit'])->name('admin.perfil.edit');

    // Enviar livro editado
    Route::put('/admin/perfil/{user}', [AdminController::class,'update'])->name('admin.perfil.edit');

    // Formulário para editar perfil
    Route::get('/admin/perfil/{user}/password', [AdminController::class, 'editPassword'])->name('admin.perfil.edit.password');

    // Enviar livro editado
    Route::put('/admin/perfil/{user}/password', [AdminController::class,'updatePassword'])->name('admin.perfil.edit.password');

    ###Rotas de livros

    // Listar todos os livros
    Route::get('/admin/books', [BookController::class,'index'])->name('admin.books.index');

    // Formulário para criar um novo livro
    Route::get('/admin/books/create', [BookController::class,'create'])->name('admin.books.create');

    // Enviar novo livro
    Route::post('/admin/books/create', [BookController::class, 'store'])->name('admin.books.create');

    // Formulário para editar livro
    Route::get('/admin/books/edit/{book}', [BookController::class, 'edit'])->name('admin.books.edit');

    // Enviar livro editado
    Route::put('/admin/books/edit/{book}', [BookController::class,'update'])->name('admin.books.edit');

    // Enviar exclusão do livro
    Route::delete('/admin/books/{book}', [BookController::class,'delete'])->name('admin.books.delete');

    ###Rotas de relatório

    // Exibir Relatório de livros mais emprestados
    Route::get('/admin/reports/most-borrowed-books', [ReportController::class, 'mostBorrowedBooks'])->name('admin.reports.most-borrowed-books');

    // Exibir Relatório de usuários mais ativos
    Route::get('/admin/reports/most-active-users', [ReportController::class, 'mostActiveUsers'])->name('admin.reports.most-active-users');

    ###Rotas de usuário
    // Listar todos os usuarios
    Route::get('/admin/users', [UserController::class,'index'])->name('admin.users.index');

    // Formulário para criar um novo usuario
    Route::get('/admin/users/create', [UserController::class,'create'])->name('admin.users.create');

    // Enviar novo usuario
    Route::post('/admin/users/create', [UserController::class, 'store'])->name('admin.users.create');

    // Formulário para editar usuario
    Route::get('/admin/users/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');

    // Enviar usuario editado
    Route::put('/admin/users/edit/{user}', [UserController::class,'update'])->name('admin.users.edit');

    // Enviar exclusão do usuario
    Route::delete('/admin/users/{user}', [UserController::class,'delete'])->name('admin.users.delete');

    // Formulário para editar senha
    Route::get('/admin/users/{user}/password', [UserController::class, 'editPassword'])->name('admin.users.edit.password');

    // Enviar senha editada
    Route::put('/admin/users/{user}/password', [UserController::class,'updatePassword'])->name('admin.users.edit.password');
});

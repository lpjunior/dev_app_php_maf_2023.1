<?php

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
| Rotas do Cliente
|--------------------------------------------------------------------------
*/

// Página Principal
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Detalhes do livro
Route::get('/books/{book}', [ClientController::class,'show'])->name('client.books.show');

// Formulário para fazer reserva
Route::get('/books/{book}/reserve', [ClientController::class,'showReservationForm'])->name('client.reserve.form');

// Enviar reserva
Route::post('/books/{book}/reserve', [ClientController::class,'reserve'])->name('client.reserve');

// Listagem de reservas
Route::get('/reservations', [ClientController::class,'reservations'])->name('client.reservations');
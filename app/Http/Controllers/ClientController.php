<?php

namespace App\Http\Controllers;

use App\Models\Book;
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

    public function show(Book $book) 
    {
        return view('client.books.show', compact('book'));
    }
}

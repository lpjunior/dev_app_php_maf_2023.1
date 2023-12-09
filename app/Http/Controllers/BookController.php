<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Exibe uma lista de todos os livros
    */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Mostra o formulário de cadastro de um novo livro
    */
    public function create()
    {
        return view ('admin.books.create');
    }

    /**
     * Armazena um novo livro no banco de dados
    */
    public function store(Request $request)
    {
        //dd($request->all()); # Log Debug
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:100',
            'isbn' => ['required', 'string', 'regex:/^\d{10}(\d{3})?$/', 'unique:books'],
            'year_published' => 'required|integer|before_or_equal:' . now()->year,
            'quantity' => 'required|integer|min:0|max:5'
        ]);

        Book::create($request->all());
        Log::info("[BookController][store] - Payload: {json_encode($request->all())}");
        return redirect()->route('admin.books.index')->with('success', 'Livro adicionado com sucesso.');
    }

    /**
     * Mostra o formulário para editar de um livro existente.
    */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Atualiza um livro no banco de dados
    */
    public function update(Request $request, Book $book)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:100',
            'isbn' => ['required', 'string', 'regex:/^\d{10}(\d{3})?$/', 'unique:books,isbn,' . $book->id],
            'year_published' => 'required|integer|before_or_equal:' . now()->year,
            'quantity' => 'required|integer|min:0|max:5'
        ]);


        $book->update($request->all());
        Log::info("[BookController][update] - Payload: {json_encode($request->all())}");
        return redirect()->route('admin.books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    /**
     * Exclui um livro do banco de dados.
    */
    public function delete(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Livro excluído com sucesso.');
    }
}

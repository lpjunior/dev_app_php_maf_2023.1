<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::query()->paginate(10);

        return response()->json([
            'currentPage' => $books->currentPage(),
            'data' => $books->items(),
            'perPage' => $books->perPage(),
            'total' => $books->total(),
            'lastPage' => $books->lastPage(),
            'previousPage' => $books->previousPageUrl(),
            'nextPage' => $books->nextPageUrl(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

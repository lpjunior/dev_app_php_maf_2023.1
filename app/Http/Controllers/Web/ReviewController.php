<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function review(Book $book)
    {
        return view('client.books.review.form', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $review = new Review([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        $book->reviews()->save($review);

        return redirect()->route('client.books.show', $book)->with('success', 'Avaliação enviada');
    }
}

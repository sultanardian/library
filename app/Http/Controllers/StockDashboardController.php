<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class StockDashboardController extends Controller
{
    public function home()
    {
        $books = Book::with('category')->get();
        return view('content.content_stocks', compact('books'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required',
            'stocks' => 'required',
        ]);
        // return $validatedData;

        $book = Book::find($validatedData['book_id']);
        $book->stocks = $validatedData['stocks'];
        $book->save();       

        return redirect()->back();
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'book_id' => 'required',
            'stocks' => 'required'
        ]);
        $book = Book::find($validatedData['book_id']);
        $book->stocks = $validatedData['stocks'];
        $book->save();
        return redirect()->back();
    }

    public function destroy(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'book_id' => 'required',
        ]);

        $book = Book::find($validatedData['book_id']);
        $book->stocks = 0;
        $book->save();       

        return redirect()->back();
    }
}
    
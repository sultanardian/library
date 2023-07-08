<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookDashboardController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $books = Book::with('category')->get();
        return view('content.content_books', compact('books', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_code' => 'required',
            'title' => 'required',
            'year' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'class_code' => 'required',
            'shelf_position' => 'required',
            'book_origin' => 'required',
            'category_id' => 'required',
        ]);

        foreach ($validatedData as $key => $value)
        {
            $validatedData[$key] = $this->capitalize($value);
        }

        $validatedData['stocks'] = 0;
        // return $validatedData;

        $category = Category::where('id', $validatedData['category_id'])
                            ->first();

        $book = $category->book()->create($validatedData);

        return redirect()->back();
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'book_code' => 'required',
            'title' => 'required',
            'year' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'class_code' => 'required',
            'shelf_position' => 'required',
            'book_origin' => 'required',
            'category_id' => 'required',
        ]);

        $book->book_code = $request->input('book_code');
        $book->title = $request->input('title');
        $book->year = $request->input('year');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->isbn = $request->input('isbn');
        $book->class_code = $request->input('class_code');
        $book->shelf_position = $request->input('shelf_position');
        $book->book_origin = $request->input('book_origin');
        $book->category_id = $request->input('category_id');
        $book->save();

        return redirect()->route('books');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books')->with('success', 'Data has been deleted successfully');
    }

    private function capitalize($text)
    {
        $lower = strtolower($text);
        $cap = ucwords($lower);
        return $cap;
    }
}

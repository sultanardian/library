<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentDashboardController extends Controller
{
    public function home()
    {
        $students = Student::all();
        return view('content.content_member', compact('students'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identifier' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'class' => 'required',
            'place_birth' => 'required',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'address' => 'required',
        ]);

        foreach ($validatedData as $key => $value)
        {
            $validatedData[$key] = $this->capitalize($value);
        }

        $student = new Student;
        $student->identifier = $validatedData['identifier'];
        $student->name = $validatedData['name'];
        $student->gender = $validatedData['gender'];
        $student->class = $validatedData['class'];
        $student->place_birth = $validatedData['place_birth'];
        $student->date_birth = $date_birth = sprintf('%d-%d-%d', $request['year'], $request['month'],  $request['date']);
        $student->address = $validatedData['address'];
        $student->save();

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

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('member')->with('success', 'Data has been deleted successfully');
    }

    private function capitalize($text)
    {
        $lower = strtolower($text);
        $cap = ucwords($lower);
        return $cap;
    }
}

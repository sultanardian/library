<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryDashboardController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view('content/content_category', compact('categories'));
    }


    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'code' => 'required',
            'category' => 'required',
        ]);

        $validatedData['code'] = $this->capitalize($validatedData['code']);
        $validatedData['category'] = $this->capitalize($validatedData['category']);
        // return $validatedData;
        $cat = new Category;
        $cat->code = $validatedData['code'];
        $cat->category = $validatedData['category'];
        $cat->save();

        return redirect()->back();
    }

    public function update(Request $request, Category $category)
    {
        $request['category'] = $this->capitalize($request['category']);
        $category->category = $request->input('category');
        $category->save();
        return redirect()->route('category');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category')->with('success', 'Data has been deleted successfully');
    }

    private function capitalize($text)
    {
        $lower = strtolower($text);
        $cap = ucwords($lower);
        return $cap;
    }
}

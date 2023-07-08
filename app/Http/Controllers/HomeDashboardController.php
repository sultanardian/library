<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use Illuminate\Http\Request;

class HomeDashboardController extends Controller
{

    public function home()
    {
        $datas = [
            'totalBooks' => Book::all()->count(),
            'totalCategories' => Category::all()->count(),
            'totalLoans' => Loan::all()->count(),
        ];
        
        return view('content.content_home', compact('datas'));
    }
}
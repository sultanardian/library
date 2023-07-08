<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanDashboardController extends Controller
{
    public function home()
    {
        $loans = Loan::all();
        return view('content.content_loan', compact('loans'));
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeDashboardController;
use App\Http\Controllers\VisitDashboardController;
use App\Http\Controllers\BookDashboardController;
use App\Http\Controllers\CategoryDashboardController;
use App\Http\Controllers\StockDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\LoanDashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Registration Routes
Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register']);

// Login Routes
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);

// Logout Route
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Dashboard after login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('home', [HomeDashboardController::class, 'home'])->name('home-dashboard')->middleware('auth');

// Visit
Route::get('visits', [VisitDashboardController::class, 'home'])->name('visits-dashboard')->middleware('auth');
Route::post('storeVisit', [VisitDashboardController::class, 'store'])->name('storeVisit')->middleware('auth');
Route::put('updateVisit/{visit}', [VisitDashboardController::class, 'update'])->name('updateVisit')->middleware('auth');
Route::delete('deleteVisit/{visit}', [VisitDashboardController::class, 'destroy'])->name('deleteVisit')->middleware('auth');

// Book
Route::get('books', [BookDashboardController::class, 'home'])->name('books')->middleware('auth');
Route::post('storeBook', [BookDashboardController::class, 'store'])->name('storeBook')->middleware('auth');
Route::put('updateBook/{book}', [BookDashboardController::class, 'update'])->name('updateBook')->middleware('auth');
Route::delete('deleteBook/{book}', [BookDashboardController::class, 'destroy'])->name('deleteBook')->middleware('auth');

// Category
Route::get('category', [CategoryDashboardController::class, 'home'])->name('category')->middleware('auth');
Route::post('storeCategory', [CategoryDashboardController::class, 'store'])->name('storeCategory')->middleware('auth');
Route::put('updateCategory/{category}', [CategoryDashboardController::class, 'update'])->name('updateCategory')->middleware('auth');
Route::delete('deleteCategory/{category}', [CategoryDashboardController::class, 'destroy'])->name('deleteCategory')->middleware('auth');

// Stock
Route::get('stocks', [StockDashboardController::class, 'home'])->name('stocks')->middleware('auth');
Route::post('storeStock', [StockDashboardController::class, 'store'])->name('storeStock')->middleware('auth');
Route::put('updateStock/{stock}', [StockDashboardController::class, 'update'])->name('updateStock')->middleware('auth');
Route::delete('deleteStock', [StockDashboardController::class, 'destroy'])->name('deleteStock')->middleware('auth');

// Student
Route::get('member', [StudentDashboardController::class, 'home'])->name('member')->middleware('auth');
Route::post('storeStudent', [StudentDashboardController::class, 'store'])->name('storeStudent')->middleware('auth');
Route::put('updateStudent/{student}', [StudentDashboardController::class, 'update'])->name('updateStudent')->middleware('auth');
Route::delete('deleteStudent/{student}', [StudentDashboardController::class, 'destroy'])->name('deleteStudent')->middleware('auth');

// Loan
Route::get('loan', [LoanDashboardController::class, 'home'])->name('loan')->middleware('auth');
Route::post('storeLoan', [LoanDashboardController::class, 'store'])->name('storeLoan')->middleware('auth');
Route::put('updateLoan/{loan}', [LoanDashboardController::class, 'update'])->name('updateLoan')->middleware('auth');
Route::delete('deleteLoan/{loan}', [LoanDashboardController::class, 'destroy'])->name('deleteLoan')->middleware('auth');
<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/liatnilai', [StudentController::class, 'index'])->name('liatnilai');
Route::get('/bookrent', [StudentController::class, 'bookRent'])->name('book.rent');
Route::post('/show-nilai', [StudentController::class, 'showNilai'])->name('show.nilai');

Route::post('/rent-book', [StudentController::class, 'rentBook'])->name('rent.book');
Route::post('/search-book', [StudentController::class, 'searchBook'])->name('search.book');
Route::post('/return-book', [StudentController::class, 'returnBook'])->name('return.book');

Route::get('/librarian', [LibrarianController::class, 'index'])->name('librarian');
Route::post('/search-librarian', [LibrarianController::class, 'searchLibrarian'])->name('search.librarian');
Route::post('/acc-librarian', [LibrarianController::class, 'accLibrarian'])->name('acc.librarian');

Route::get('/inputnilai', [TeacherController::class, 'index'])->name('inputnilai');
Route::post('/input-nilai', [TeacherController::class, 'inputNilai'])->name('input.nilai');
Route::post('/detail-nilai', [TeacherController::class, 'detailNilai'])->name('detail.nilai');

Route::get('/principal', [PrincipalController::class, 'index'])->name('principal');
Route::post('/tambah-data', [PrincipalController::class, 'tambahData'])->name('tambah.data');

Route::get('/profile', [GeneralController::class, 'index'])->name('profile');
Route::view('/dashboard', 'dashboard');
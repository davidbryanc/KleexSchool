<?php

use App\Http\Controllers\Auth\LoginController;
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

// Guest 
Route::get('/', function () { return view('auth.login'); });
Auth::routes();
Route::post('/login', [LoginController::class, 'loginCheck'])->name('logincheck');

// Login User
Route::group(['middleware' => 'auth'],
    function () {
        Route::get('/dashboard', [GeneralController::class, 'index'])->name('dashboard');
    }
);

// Student
Route::group(['middleware' => 'student'],
    function () {
        Route::get('/score-report', [StudentController::class, 'index'])->name('score-report');
        Route::get('/book-rent', [StudentController::class, 'bookRent'])->name('book.rent');
        Route::post('/show-nilai', [StudentController::class, 'showNilai'])->name('show.nilai');
        
        Route::post('/rent-book', [StudentController::class, 'rentBook'])->name('rent.book');
        Route::post('/search-book', [StudentController::class, 'searchBook'])->name('search.book');
        Route::post('/return-book', [StudentController::class, 'returnBook'])->name('return.book');
    }
);

Route::group(['middleware' => 'principal'],
    function () {
        Route::get('/principal', [PrincipalController::class, 'index'])->name('principal');
        Route::post('/add-data', [PrincipalController::class, 'tambahData'])->name('add.data');
    }
);

Route::group(['middleware' => 'teacher'],
    function () {
        Route::get('/score-input', [TeacherController::class, 'index'])->name('score.input');
        Route::post('/input-nilai', [TeacherController::class, 'inputNilai'])->name('input.nilai');
        Route::post('/detail-nilai', [TeacherController::class, 'detailNilai'])->name('detail.nilai');
    }
)
;
Route::group(['middleware' => 'librarian'],
    function () {
        Route::get('/librarian', [LibrarianController::class, 'index'])->name('librarian');
        Route::post('/acc-librarian', [LibrarianController::class, 'accLibrarian'])->name('acc.librarian');
    }
);





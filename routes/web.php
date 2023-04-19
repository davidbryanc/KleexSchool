<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
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
Route::post('/show-nilai', [StudentController::class, 'showNilai'])->name('show.nilai');


Route::view('/dashboard', 'dashboard');
Route::view('/inputnilai', 'inputnilai');
Route::view('/librarian', 'librarian');
Route::view('/bookrent', 'bookrent');

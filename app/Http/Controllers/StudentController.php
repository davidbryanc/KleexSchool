<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRent;
use App\Models\Grade;
use App\Models\Period;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $period_id = $user->student->grade()->get('period_id');
        $periods = Period::find($period_id);
        
        return view('liatnilai', compact('user', 'periods'));
    }

    public function bookRent()
    {
        $user = auth()->user();
        $book_id = $user->student->bookRent()->get('book_id');
        $books = Book::whereNotIn('id', $book_id)->get();
        $rents = Book::whereIn('id', $book_id)->get();

        return view('bookrent', compact('user', 'books', 'rents'));
    }
    
    public function showNilai(Request $request)
    {
        $user = auth()->user();
        $period_id = $request->period_id;
        
        $grades = $user->student->grade()->where('period_id', $period_id)->get();

        $subjects = Subject::all();
        return response()->json(array(
            'grades' => $grades,
            'subjects' => $subjects,
        ), 200);
    }

    public function rentBook(Request $request){
        $id = $request->id;
        $user = auth()->user();

        $book_id = $user->student->bookRent()->get('book_id');
        $total_book = count(Book::whereIn('id', $book_id)->get());

        if($total_book < 3){

            $rent = new BookRent;
            $rent->student_id = $user->id;
            $rent->book_id = $id;
            $rent->save();

            
            $status = "Success";
        }else{
            $status = "Failed";
        }

        $book_id = $user->student->bookRent()->get('book_id');
        $books = Book::whereNotIn('id', $book_id)->get();
        $rents = Book::whereIn('id', $book_id)->get();

        return response()->json(array(
            'status' => $status,
            'books' => $books,
            'rents' => $rents,
        ), 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRent;
use App\Models\Grade;
use App\Models\Period;
use App\Models\Subject;
use PDF;
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
        $book_id = $user->student->bookRent()->where('librarian_id', null)->orderBy('book_id')->get('book_id');
        $rents = BookRent::where('student_id', $user->student->id)->where('librarian_id', null)->orderBy('book_id')->get();
        $books = Book::whereNotIn('id', $book_id)->get();

        return view('bookrent', compact('user', 'books', 'rents'));
    }
    
    public function showNilai(Request $request)
    {
        $user = auth()->user();
        $period_id = $request->period_id;
        
        $grades = $user->student->grade()->where('period_id', $period_id)->get();

        $subjects = Subject::all();
        
        $semester = Period::where('id', $period_id)->first()->name;
        return response()->json(array(
            'grades' => $grades,
            'subjects' => $subjects,
            'semester' => $semester,
        ), 200);
    }

    public function rentBook(Request $request){
        $id = $request->id;
        $user = auth()->user();

        $total_book = count($user->student->bookRent()->where('librarian_id', null)->get('book_id'));

        if($total_book < 3){

            $rent = new BookRent;
            $rent->student_id = $user->student->id;
            $rent->book_id = $id;
            $rent->save();

            
            $status = "Success";
        }else{
            $status = "Failed";
        }

        $book_id = $user->student->bookRent()->where('librarian_id', null)->orderBy('book_id')->get('book_id');
        $rents = BookRent::where('student_id', $user->student->id)->where('librarian_id', null)->orderBy('book_id')->get();
        $books = Book::whereNotIn('id', $book_id)->get();
        $books2 = Book::whereIn('id', $book_id)->get();

        return response()->json(array(
            'status' => $status,
            'books' => $books,
            'books2' => $books2,
            'rents' => $rents,
        ), 200);
    }

    public function returnBook(Request $request){
        $id = $request->id;
        $user = auth()->user();

        $target = $user->student->bookRent()->where('book_id', $id)->where('is_returned', 0)->first();
        $book = BookRent::find($target->id);
        $book->increment('is_returned');

        $status = "Success";

        $book_id = $user->student->bookRent()->where('librarian_id', null)->orderBy('book_id')->get('book_id');
        $rents = BookRent::where('student_id', $user->student->id)->where('librarian_id', null)->orderBy('book_id')->get();
        $books = Book::whereNotIn('id', $book_id)->get();
        $books2 = Book::whereIn('id', $book_id)->get();

        return response()->json(array(
            'status' => $status,
            'books' => $books,
            'books2' => $books2,
            'rents' => $rents,
        ), 200);
    }

    public function searchBook(Request $request){
        $value = $request->value;
        $user = auth()->user();

        $book_id = $user->student->bookRent()->where('librarian_id', null)->orderBy('book_id')->get('book_id');
        $books = Book::whereNotIn('id', $book_id)->where('name', 'like', '%'.$value.'%')->get();

        return response()->json(array(
            'books' => $books,
        ), 200);
    }

    // public function exportPdf(){
    //     $subjects = Subject::all();

    //     view()->share('subjects',$subjects);
    //     $pdf = PDF::loadview('liatnilai-pdf');

    //     return $pdf -> download('nilai.pdf');
    // }
}

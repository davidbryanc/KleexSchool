<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookRent;
use App\Models\Student;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    public function index(){
        $user = auth() -> user();

        $rented = BookRent::where('is_returned',1)->where('librarian_id',null)->get();

        return view('librarian', compact('user','rented'));
    }

    public function searchLibrarian(Request $request){
        $value = $request->value;
        $user = auth()->user();

        $rented = BookRent::where('is_returned',1)->get('student_id');

        $search = Student::whereIn('id',$rented)->where('name', 'like', '%'.$value.'%')->get();

        return response()->json(array(
            'name_searched' => $search,
        ), 200);
    }

    public function accLibrarian(Request $request){
        $id = $request->id;
        $user = auth()->user();

        $rented = BookRent::find($id); 

        $rented->librarian_id=$user->teacher->id;
        $rented->return_date=date('Y-m-d H:i:s');

        $rented->save();

        $rented_update = BookRent::where('is_returned',1)->get();
        return response()->json(array(
            'rented_update' => $rented_update,
        ), 200);
    }
}

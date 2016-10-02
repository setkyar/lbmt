<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Datatables;
use App\Books;
use Carbon\Carbon;
use App\BorrowRecords;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function showBooks(Request $request)
    {
    	if ($request->ajax()) {
    		return Datatables::of(Books::where('qty_left', '>', 0))->make(true);
    	}

        return view('member.book_lists');
    }

    public function borrowedBooks(Request $request)
    {
        $borrow_books = BorrowRecords::where('user_id', Auth::id())->where('return', false)->get();

    	return view('member.borrow_books', compact('borrow_books'));
    }

    public function borrowBook(Request $request, $id)
    {
    	$book = Books::findOrFail($id);

    	if ($book->qty_left > 0) {
 			
 			if (Carbon::parse(Auth::user()->birthday)->diff(Carbon::now())->format('%y') <= 12) {
 				$user_available_borrow_book = 3;
 			} else {
 				$user_available_borrow_book = 6;
 			}

    		if (BorrowRecords::where('user_id', Auth::id())->count() < $user_available_borrow_book) {
                
    			$data = [
    				'user_id' => Auth::id(),
					'book_id' => $id,
					'borrow_time' => Carbon::now(),
					'return'	=> false
    			];

    			BorrowRecords::create($data);
    			$book->decrement('qty_left');
    			$book->increment('qty_borrow');	

    			Session::flash('flash_message', 'Success borrowing book!');
				return redirect()->back();
    		} else {
				Session::flash('flash_message', 'Oops! You are trying over!');
				return redirect()->back();				    			
    		}
    	}

    	Session::flash('flash_message', 'Not available right now!');

 		return redirect()->back();
    }

    public function returnBook(Request $request, $id)
    {
        BorrowRecords::where('book_id', $id)->where('user_id', Auth::id())->first()->delete();

    	$book = Books::findOrFail($id);
    	$book->increment('qty_left');
    	$book->decrement('qty_borrow');

    	Session::flash('flash_message', 'Your return of this book is success!');

 		return redirect()->back();
    }
}

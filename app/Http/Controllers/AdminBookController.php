<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Datatables;
use App\Books;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminBookController extends Controller
{
    public function manageBooks(Request $request)
    {
    	if ($request->ajax()) {
    		return Datatables::of(Books::all())->make(true);
    	}

        return view('admin.books.index');
    }

    public function createUpdateBook(Request $request, $id='')
 	{
 		if ($id !=='') {
 			$book = Books::findOrFail($id);	
 			return view('admin.books.book', compact('book')); 			
 		}

 		return view('admin.books.book');
 	}

 	public function saveBook(Request $request, $id='')
 	{
 		$data = $request->all();

 		$data['qty_borrow'] = 0;
 		$data['qty_left'] 	= $data['qty'];
 		$data['qty_left'] 	= $data['qty'];

 		if ($id !== '') {
 			$book = Books::findOrFail($id);

 			$book->update($data);
 			Session::flash('flash_message', 'Successfully updated book!');	
			return redirect()->back(); 			
 		}

 		$this->validate($request, [
		    'title' => 'required',
			'author' => 'required',
			'isbn' => 'required',
			'fees' => 'required',
			'qty' => 'required',
			'shelf_location' => 'required',
		]);

 		Books::create($data);
 		Session::flash('flash_message', 'Successfully added a new book!');

 		return redirect()->back();
 	}

 	public function destroyBook(Request $request, $id)
 	{
		$book = Books::findOrFail($id);
		$book->delete();
		Session::flash('flash_message', 'Successfully deleted book!');
		return redirect()->back();
 	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Datatables;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function manageUsers(Request $request)
    {
    	if ($request->ajax()) {
    		return Datatables::of(User::select(['id','name','birthday','email'])->where('role', 'user'))->make(true);
    	}

        return view('admin.users.index');
    }
 	
 	public function createUpdateUser(Request $request, $id='')
 	{
 		if ($id !== '') {
 			$user = User::findOrFail($id);	
			return view('admin.users.create', compact('user')); 			
 		}
 		
 		return view('admin.users.create');
 	}

 	public function saveUser(Request $request, $id='')
 	{
 		$data = $request->all();

 		$data['password'] = bcrypt($data['password']);
 		$data['role'] = 'user';
 		$data['birthday'] = date("d/m/Y", strtotime($data['birthday']));

 		if ($id !== '') {
 			$user = User::findOrFail($id);

 			$user->update($data);
 			Session::flash('flash_message', 'Successfully updated member!');	
			return redirect()->back(); 			
 		}

 		$this->validate($request, [
		    'name' => 'required',
		    'email' => 'required|unique:users',
		    'birthday' => 'required',
		    'password' => 'required',
		]);

 		User::create($data);
 		Session::flash('flash_message', 'Successfully added a new member!');

 		return redirect()->back();
 	}

 	public function destroyUser(Request $request, $id)
 	{
		$user = User::findOrFail($id);
		$user->delete();
		Session::flash('flash_message', 'Successfully destroy member!');	
		return redirect()->back();
 	}
}

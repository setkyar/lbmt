<?php

// Authentication routes...
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['middleware' => 'auth'], function () {
    // Only authenticated users may enter...
	Route::get('auth/logout', 'Auth\AuthController@getLogout');

	Route::get('member', 'MemberController@showBooks');
	Route::get('member/books', 'MemberController@borrowedBooks');
	
	Route::post('borrow/{id}', 'MemberController@borrowBook');
	Route::post('manage/books/{id}/return', 'MemberController@returnBook');

	Route::group(['middleware' => 'admin'], function () {
	    // Only authenticated admin may enter...

	    //Books
		Route::get('manage/books', 'AdminBookController@manageBooks');
		Route::get('manage/books/add', 'AdminBookController@createUpdateBook');
		Route::get('manage/books/{id}/edit', 'AdminBookController@createUpdateBook');

		Route::post('manage/books/store', [
		    'as' => 'book.add', 
		    'uses' => 'AdminBookController@saveBook'
		]);

		Route::put('manage/books/{id}', [
		    'as' => 'book.update', 
		    'uses' => 'AdminBookController@saveBook'
		]);
		Route::delete('manage/books/{id}', 'AdminBookController@destroyBook');

		//User
		Route::get('manage/users', 'AdminUserController@manageUsers');
		Route::get('manage/users/add', 'AdminUserController@createUpdateUser');
		Route::post('manage/users/store', [
		    'as' => 'user.add', 
		    'uses' => 'AdminUserController@saveUser'
		]);
		Route::get('manage/users/{id}/edit', 'AdminUserController@createUpdateUser');
		Route::put('manage/users/{id}', [
		    'as' => 'user.update', 
		    'uses' => 'AdminUserController@saveUser'
		]);
		Route::delete('manage/users/{id}', 'AdminUserController@destroyUser');
	});
});
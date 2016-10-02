<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowRecords extends Model
{
    protected $fillable = [
    	'user_id',
		'book_id',
		'borrow_time',
		'return'
    ];
}

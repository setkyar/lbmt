<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
    	'title',
		'author',
		'isbn',
		'fees',
		'qty',
		'qty_borrow',
		'qty_left',
		'shelf_location',
    ];
}

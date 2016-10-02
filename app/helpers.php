<?php 

function getBook($book_id)
{
	return App\Books::select('title', 'fees')->find($book_id)->first();
}
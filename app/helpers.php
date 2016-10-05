<?php 

function getBook($book_id)
{
	return App\Books::select('title', 'fees')->findOrFail($book_id);
}
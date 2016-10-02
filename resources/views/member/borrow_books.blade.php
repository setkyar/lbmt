@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>Books</h1>
			<hr>

			@if(Session::has('flash_message'))
			    <div class="alert alert-info">
			        {{ Session::get('flash_message') }}
			    </div>
			@endif
		</div>
		
		<div class="col-md-12">
			<table class="table" id="books-table">
			    <caption>All Books</caption>
			    <thead>
			        <tr>
			            <th>#</th>
			            <th>Book Name</th>
			            <th>Borrow Time</th>
			            <th>Price</th>
			            <th>Return</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($borrow_books as $book)
					<tr>
						<td>{{ $book->id }}</td>
						<td>{{ getBook($book->book_id)->title }}</td>
						<td>
							@if(Carbon::parse($book->borrow_time)->diff(Carbon::now())->format('%d') === "0")
								Today
							@elseif(Carbon::parse($book->borrow_time)->diff(Carbon::now())->format('%d') > 14)
								Failure to return!
							@else
								Carbon::parse($book->borrow_time)->diff(Carbon::now())->format('%d') Already!
							@endif
						</td>
						<td>
							@if(Carbon::parse($book->borrow_time)->diff(Carbon::now())->format('%d') > 14)
								{{ getBook($book->book_id)->fees + (Carbon::parse($book->borrow_time)->diff(Carbon::now())->format('%d') - 14 * 10) }}
							@else 
								{{ getBook($book->book_id)->fees }}
							@endif
						</td>
						<td>
							<form method="POST" action="/manage/books/{{ $book->book_id }}/return" accept-charset="UTF-8">
								<input name="_token" type="hidden" value="<?php echo csrf_token(); ?>">
								<input class="btn btn-primary" type="submit" value="Return">
							</form>
						</td>
					</tr>
					@endforeach
			    </tbody>
			</table>
		</div>

	</div>
</div>
@endsection
@push('scripts')
<script>
$(function() {

});
</script>
@endpush

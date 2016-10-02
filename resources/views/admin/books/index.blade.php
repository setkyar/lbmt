@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>Manage Books</h1>
			<hr>
		</div>

		<div class="col-md-12">
			<table class="table" id="books-table">
			    <caption>All Books</caption>
			    <thead>
			        <tr>
			            <th>#</th>
			            <th>Title</th>
			            <th>Author</th>
			            <th>ISBN</th>
			            <th>Borrow Fees</th>
			            <th>Quantities</th>
			            <th>Quantities Left</th>
			            <th>Quantities Borrow</th>
			            <th>Shelf Location</th>
			            <th>Edit</th>
			            <th>Delete</th>
			        </tr>
			    </thead>
			    <tbody>

			    </tbody>
			</table>
			<hr>
		</div>
	
		<div class="col-md-10 col-md-offset-10">
			<a href="/manage/books/add">
				<button class="btn btn-primary">Add Book</button>
			</a>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    $('#books-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'author', name: 'author' },
            { data: 'isbn', name: 'isbn' },
            { data: 'fees', name: 'fees' },
            { data: 'qty', name: 'qty' },
            { data: 'qty_left', name: 'qty_left' },
            { data: 'qty_borrow', name: 'qty_borrow' },
            { data: 'shelf_location', name: 'shelf_location' },
            { data: 'id', name: 'id' },
            { data: 'id', name: 'id' },
        ],
        fnRowCallback: function(nRow, aData, iDisplayIndex) {
            $('td:eq(9)', nRow).html('<a href="/manage/books/'+ aData.id +'/edit" class="btn btn-warning">Edit</a>');
            $('td:last()', nRow).html('<form method="POST" action="/manage/books/'+ aData.id +'" accept-charset="UTF-8"><input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"><input name="_method" type="hidden" value="DELETE"><input class="btn btn-danger" type="submit" value="Delete"></form>');

            return nRow;
        }
    });
});
</script>
@endpush
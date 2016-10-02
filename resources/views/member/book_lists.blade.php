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
			            <th>Title</th>
			            <th>Author</th>
			            <th>ISBN</th>
			            <th>Borrow Fees</th>
			            <th>Quantities</th>
			            <th>Quantities Left</th>
			            <th>Borrow</th>
			        </tr>
			    </thead>
			    <tbody>

			    </tbody>
			</table>
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
            { data: 'id', name: 'id' },
        ],
        fnRowCallback: function(nRow, aData, iDisplayIndex) {
        	$('td:eq(7)', nRow).html('<form method="POST" action="/borrow/'+ aData.id +'" accept-charset="UTF-8"><input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"><input class="btn btn-primary" type="submit" value="Borrow"></form>');
        	
            return nRow;
        }
    });
});
</script>
@endpush

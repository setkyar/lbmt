<div class="col-md-12">
	@if($errors->any())
	    <div class="alert alert-danger">
	        @foreach($errors->all() as $error)
	            <p>{{ $error }}</p>
	        @endforeach
	    </div>
	@endif

	@if(Session::has('flash_message'))
	    <div class="alert alert-success">
	        {{ Session::get('flash_message') }}
	    </div>
	@endif

	@if(isset($book))
		<div class="col-md-12">
			<h1>Edit Book</h1>
			<hr>
		</div>
    	{!! Form::model($book, ['route' => ['book.update', $book->id], 'method' => 'put']) !!}
	@else
		<div class="col-md-12">
			<h1>Add Book</h1>
			<hr>
		</div>
	    {!! Form::open(['route' => 'book.add']) !!}
	@endif

	<div class="form-group">
	    {!! Form::label('title', 'Book Title:', ['class' => 'control-label']) !!}
	    {!! Form::text('title', null, ['class' => 'form-control']) !!}
	</div>
	
	<div class="form-group">
	    {!! Form::label('author', 'Book Author:', ['class' => 'control-label']) !!}
	    {!! Form::text('author', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('isbn', 'Book ISBN:', ['class' => 'control-label']) !!}
	    {!! Form::text('isbn', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('fees', 'Book Borrow Fees:', ['class' => 'control-label']) !!}
	    {!! Form::text('fees', null, ['class' => 'form-control']) !!}
	</div>
	
	<div class="form-group">
	    {!! Form::label('qty', 'Book Quantities:', ['class' => 'control-label']) !!}
	    {!! Form::text('qty', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('shelf_location', 'Shelf Location:', ['class' => 'control-label']) !!}
	    {!! Form::text('shelf_location', null, ['class' => 'form-control']) !!}
	</div>


	{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

</div>
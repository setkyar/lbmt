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

	@if(isset($user))
    	{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put']) !!}
	@else
	    {!! Form::open(['route' => 'user.add']) !!}
	@endif

	<div class="form-group">
	    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
	    {!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
	    {!! Form::email('email', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('birthday', 'Birthday:', ['class' => 'control-label']) !!}
	    {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
	    {!! Form::password('password', ['class' => 'form-control']) !!}
	</div>

	{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

</div>
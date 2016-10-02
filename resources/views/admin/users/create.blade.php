@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>Add Members</h1>
			<hr>
		</div>

		@include('admin.users.form')
		
	</div>
</div>
@endsection


@push('scripts')
<script>
</script>
@endpush
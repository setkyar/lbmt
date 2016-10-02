@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">

		@include('admin.books.form')
		
	</div>
</div>
@endsection


@push('scripts')
<script>
</script>
@endpush
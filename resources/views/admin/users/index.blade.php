@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>Manage Members</h1>
			<hr>
		</div>

		<div class="col-md-12">
			<table class="table" id="users-table">
			    <caption>All Members</caption>
			    <thead>
			        <tr>
			            <th>#</th>
			            <th>Name</th>
			            <th>Email</th>
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
			<a href="/manage/users/add">
				<button class="btn btn-primary">Add Member</button>
			</a>
		</div>
	</div>
</div>
@endsection


@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'id', name: 'id' },
            { data: 'id', name: 'id' },
        ],
        fnRowCallback: function(nRow, aData, iDisplayIndex) {
            $('td:eq(3)', nRow).html('<a href="/manage/users/'+ aData.id +'/edit" class="btn btn-warning">Edit</a>');
            $('td:eq(4)', nRow).html('<form method="POST" action="/manage/users/'+ aData.id +'" accept-charset="UTF-8"><input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"><input name="_method" type="hidden" value="DELETE"><input class="btn btn-danger" type="submit" value="Delete"></form>');

            return nRow;
        }
    });
});
</script>
@endpush
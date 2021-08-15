@extends('layouts.app')

@section('content') 
<div class="flex-container">
	<div class="col-sm-12">
		@if(session()->get('success'))
		<div class="alert alert-success">
			{{session()->get('success')}}
		</div>
		@endif
	</div>

	<div class="columns m-t-10">
		<div class="column">
			<h1 class="title">Manage Users</h1>
		</div>
		<div class="column">
			<a href="{{'users.create'}}" class="btn btn-primary"><i class="fa fa-user-add"></i>Create New User</a>
		</div>
	</div>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>User Name</th>
				<th>Email</th>
				<th>Date Created</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
			<tr>
				<th>{{$user->id}}</th>
				<td>{{$user->username}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->created_at->toFormattedDateString()}}</td>
				<td><a href="{{route('user_admin.edit', $user->id)}}" class="btn btn-primary">Edit</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

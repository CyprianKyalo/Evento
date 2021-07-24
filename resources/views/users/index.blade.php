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
			<a href="{{'users.create'}}" class="button is-primary is-pulled-right"><i class="fa fa-user-add"></i>Create New User</a>
		</div>
	</div>
	<hr>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Date Created</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
			<tr>
				<th>{{$user->id}}</th>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->created_at->toFormattedDateString()}}</td>
				<td><a href="{{route('users.edit', $user->id)}}" class="button is-outlined">Edit</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

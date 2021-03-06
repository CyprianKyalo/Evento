@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-sm-8 offset-sm-2">
		<h1 class="display-3">Update your profile</h1>

		@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		<br>
		@endif

		<form action="{{route('users.update', $user->id)}}">
			@method('PATCH')
			@csrf

			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" name="name" value="{{$user->name}}">
			</div>

			<div class="form-group">
				<label for="email">Email:</label>
				<input type="text" class="form-control" name="email" value="{{$user->email}}">
			</div>

			<div class="form-group">
				<label for="profile-photo">Photo:</label>
				<input type="text" class="form-control" name="profile-photo">
			</div>

			<button class="btn btn-primary">Update Profile</button>

		</form>
	</div>
</div>

@endsection()
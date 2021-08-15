@extends('layouts.app')
{{-- @include('layouts.sidebar') --}}

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
			<a href="{{'product_admin.create'}}" class="btn btn-primary"><i class="fa fa-user-add"></i>Create New Product</a>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Product Name</th>
				<th>Description</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($products as $product)
			<tr>
				<th>{{$product->product_id}}</th>
				<td>{{$product->name}}</td>
				<td>{{$product->description}}</td>
				<td>{{$product->status}}</td>
				<td><a href="{{-- {{route('user_admin.edit', $user->id)}} --}}" class="btn btn-primary">Edit</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

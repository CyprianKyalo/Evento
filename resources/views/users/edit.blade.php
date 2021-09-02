{{-- @extends('layouts.app')

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

@endsection() --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento | Landing</title>
    <style>
        /* general styling */
        * {
            margin: 0;
        }

        body {
            height: 100vh;
            display: grid;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            grid-template-rows: 8.5% auto 8.5%;
        }

        header {
            grid-row: 1 / 2;
            border-bottom: 1px solid #ccc;
        }

        header ul {
            padding: 0;
            float: right;
        }

        header ul li {
            list-style: none;
            padding: 20px;
        }

        header ul li a {
            text-decoration: none;
            margin: 20px 30px 0 30px;
            padding: 20px;
            border: 1px solid #888;
            color: #fff;
            background-color: #000;
        }

        header ul li a:hover {
            color: #000;
            background-color: #fff;
        }

        main {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            height: 100%;
            grid-row: 2 / 3;
        }

        footer {
            grid-row: 3 / 4;
            border-top: 1px solid #ccc;
        }

        footer p {
            margin: 15px 30px;
        }

        aside {
            grid-column: 1 / 3;
            text-align: center;
            padding: 100px 15px 15px 15px;
            border-right: 1px solid #ccc;
        }

        article {
            grid-column: 3 / -1;
            padding: 56px 15px 15px 50px;
        }

        #aside-navigation {
            padding: 0;
        }

        #aside-navigation li{
            list-style: none;
            padding: 5px;
            text-align: center;
        }

        .user-navigation {
            display: inline-block;
            padding: 10px;
            width: 60%;
            text-decoration: none;
            border: 1px solid #888;
            color: #fff;
            background-color: #000;
        }

        .user-navigation:hover {
            color: #000;
            background-color: #fff;
        }

        /* profile */
        .profile-img {
            border-radius: 50%;
        }

        .profile-aside-img {
            margin-bottom: 20px;
        }

        .profile-article-img {
            height: 150px;
            width: 150px;
            margin-top: 25px;
            margin-right: 15px;
        }

        input {
            display: block;
            padding: 15px;
            margin: 10px;
            width: 545px;
            border: 1px solid #ccc;
        }

        form {
            width: 600px;
            margin: 20px;
        }

        #profile-button {
            width: 577px;
            color: #fff;
            background-color: #000;
            padding: 15px;
            border: 1px solid #ccc;
            margin-left: 10px;
        }

        #profile-button:hover {
            color: #000;
            background-color: #fff;
        }

        #profile-activity {
            display: flex;
            padding: 20px;
            width: 90%;
        }
    </style>
</head>
<body>
    <header>
        <ul>
            <li><a href="#">Logout</a></li>
        </ul>
    </header>
    <main>
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



        <aside>
            <img src="https://via.placeholder.com/150" alt="user profile" class="profile-img profile-aside-img">
            <ul id="aside-navigation">
                <li><a href="{{route('users.index')}}" class="user-navigation">Profile</a></li>
                <li><a href="{{route('activity')}}" class="user-navigation">Activity</a></li>
                <li><a href="{{route('products.index')}}" class="user-navigation">Equipment</a></li>
                <li><a href="{{route('services')}}" class="user-navigation">Services</a></li>
            </ul>
        </aside>
        <article>
            <section id="profile-activity">
                <img src="https://via.placeholder.com/150" alt="user profile" class="profile-img profile-article-img">
                <form action="{{route('users.update', $user->id)}}" method="POST">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <input type="text" placeholder="Name" name="name" value="{{$user->name}}">
                    
                    <input type="text" placeholder="Email" name="email" value="{{$user->email}}">
                    <input type="text" placeholder="Password">
                    <input type="text" placeholder="First Name">
                    <input type="text" placeholder="Last Name">
                    <label for="profile" style="margin: 10px;">Profile Picture</label>
                    <input type="file" name="profile" id="">
                    <button id="profile-button">Update Profile</button>
                    
                    
                </form>
            </section>
        </article>
    </main>
    <footer>
        <p>&copy2021 Evento, Inc.</p>
    </footer>
</body>
</html>
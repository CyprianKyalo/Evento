<!DOCTYPE html>
<html>
<head>
{{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento | Landing</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">Dashboard</a>
  <a href="{{route('user_admin.index')}}">Users</a>
  <a href="{{route('product_admin.index')}}">Products</a>
  <a href="#">Contact</a>
</div>

<div id="main">
  {{-- <h2>Sidenav Push Example</h2>
  <p>Click on the element below to open the side navigation menu, and push this content to the right. Notice that we add a black see-through background-color to body when the sidenav is opened.</p>
 --}}
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

 
  <div class="section" style="margin-left: 3rem; margin-top: -3rem">
  	<h1>Users</h1>

  	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>User Name</th>
				<th>Email</th>
				<th>Date Created</th>
				<th>Edit</th>
				<th>Suspend</th>
				<th>Disable</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
			<tr>
				<th>{{$user->id}}</th>
				<td>{{$user->username}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->created_at->toFormattedDateString()}}</td>
				<td><a href="{{route('user_admin.edit', $user->id)}}" class="btn btn-primary"><i class="fa fa-eye" style="margin-right: 2px"></i>Edit</a></td>
				<td><a href="#" class="btn btn-warning"><i class="fa fa-bell"></i>Suspend</a></td>
				<td><a href="#" class="btn btn-danger"><i class="fa fa-trash" style="margin-right: 2px"></i>Delete</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>          
  </div>

   
</div>

<script>
	function openNav() {
	  document.getElementById("mySidenav").style.width = "250px";
	  document.getElementById("main").style.marginLeft = "250px";
	  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	  document.getElementById("main").style.marginLeft= "0";
	  document.body.style.backgroundColor = "white";
	}
</script>
   
</body>
</html> 

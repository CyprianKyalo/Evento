@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Evento</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <script src="{{asset('js/app.js')}}" defer></script>

        <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}">

        <style type="text/css">
        	.custom-class {
        		align-items: center;
        		justify-content: center;
        	}
        </style>
    </head>

    <body>
		<header>
			<nav>
				<ul id="site-nav-list">
					<li class="site-link home-link"><a href="#">Evento</a></li>
					<li class="site-link"><a href="#">About Us</a></li>
					<li class="site-link"><a href="#">Equipment</a></li>
					<li class="site-link"><a href="#">Services</a></li>
					<li class="site-link"><a href="#">Sign In</a></li>
					<li class="site-link"><a href="#">Sign Up</a></li>
				</ul>
			</nav>
		</header>
		<main>
			<header>
				<h1>Create your best event yet.</h1>
				<p>Everything and everyone you need in one place.</p>
				<p><a href="">Sign Up</a></p>
			</header>
		</main>
        <div class="container-fluid">
        	<div class="row border border-dark">
        		<div class="col border p-5">
        			<div>
        				<h1 class="">Evento</h1>
        			</div>
        			<div class="mt-5">
        				<h2 class="">The best event management platform</h2>
        			</div>

        			
        		</div>

	        	<div class="col border">
	        		{{-- Register --}}
	        		{{-- @include('auth.register') --}}
        		</div>
        	</div>

        	<div class="container mt-5">
        		<p>
        			Lorem ipsum dolor sit, amet, consectetur adipisicing elit. Dolorem architecto, blanditiis, provident omnis minima eveniet impedit magni ipsam. Minus accusantium esse exercitationem iusto excepturi quia aspernatur aut unde illum sunt.
        		</p>
        	</div>

        	<div class="card-deck mt-5">
        		<div class="card" style="max-width: 270px">
        			<img src="{{'assets/event1.jpg'}}" alt="" class="card-img" style="height: 300px; width: 270px">
        		</div>

        		<div class="card" style="max-width: 270px">
        			<img src="{{'assets/event2.jpg'}}" alt="" class="card-img" style="height: 300px; width: 270px">
        		</div>

        		<div class="card" style="max-width: 270px">
        			<img src="{{'assets/event3.jpg'}}" alt="" class="card-img" style="height: 300px; width: 270px">
        		</div>
        		
        	</div>

        	<div class="container-fluid mt-5">
        		<div class="row align-items-start ">
        			<div class="col">
        				<img src="{{'assets/event7.jpg'}}" alt="" class="" style="max-width: 95%">
        			</div>
        			<div class="col">
        				<p>
        					Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ratione recusandae voluptatibus quis eligendi dolorum fugit odit numquam porro sit sint exercitationem aliquid omnis et, eos. Dolor, reiciendis non esse!
        				</p>
        				
        			</div>
        		</div>
        	</div>

        	<div class="container-fluid mt-5">
        		<div class="row align-items-start">
        			<div class="col">
        				Lorem, ipsum dolor sit amet consectetur, adipisicing elit. Quas quos voluptatibus delectus. Maiores deserunt inventore possimus facere reprehenderit corporis nulla, hic eligendi fuga rerum sunt exercitationem enim assumenda consequatur sequi!
        			</div>
        			<div class="col">
        				<img src="{{'assets/event6.jpg'}}" alt="" class="" style="max-width: 95%">
        			</div>
        		</div>
        	</div>
    
        </div>
        
       
        
    </body>
</html>
@endsection

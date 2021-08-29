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

        <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    </head>
    <body>
		<!-- <main class="home-page-content"> -->
		<header class="welcome-container">
			<h1 class="welcome-text">Create your best event yet!</h1>
			<p class="welcome-sub-text">Everything and everyone you need in one place.</p>
			<p class="signup-button"><a href="" class="intro-signup-button">Sign Up</a></p>
		</header>
		<article class="home-page-content">
			<section class="platform-intro">
				<div class="intro">
					<div class="platform-intro-text">
						<h2>Event Management <br> Re-imagined & simplified</h2>
						<p>A platform with everything you need to create a memorable event in one place.</p>
					</div>
					<div class="intro-images">
						<img src="{{'assets/andreas-ronningen-S2YssLw97l4-unsplash.jpg'}}" alt="" class="intro-card card-1">
						<img src="{{'assets/al-elmes-ULHxWq8reao-unsplash.jpg'}}" alt="" class="intro-card card-2">
						<img src="{{'assets/chuttersnap-ZZOCECWiwBI-unsplash.jpg'}}" alt="" class="intro-card card-3">
					</div>
				</div>
				<h2 style="text-align: center; margin-bottom: 20px;">Explore equipments and services at your disposal <br> to create events as desired.</h2>
				<div class="equipments items-intro">
					<div class="items-text">
						<h3>Find the best equipments to suit your budget.</h3>
						<p>All kinds of equipments to build your events at your convenient price range. From tents to speakers to lighting, all in one place!</p>
						<a href="" class="items-link">Learn More</a>
						<h3>Summon the best services that to come with the equipments.</h3>
						<p>Bring on other stakeholders on board while creating your event who can provide the best services at your price range.</p>
						<a href="" class="items-link">Learn More</a>
					</div>
					<img src="{{'assets/valentin-petkov-7CkGxSBGNgU-unsplash.jpg'}}" alt="" class="platform-images equipment-image">
					<img src="{{'assets/marc-babin-aQWmCH_b3MU-unsplash.jpg'}}" alt="" class="platform-images services-image">
				</div>
			</section>
			<section class="vendor-consumer-info">
				<h2>Consumer or vendor, is it too much to ask for both?</h2>
				<p>We bring you a chance to create your events while staying in business in a vibrant, untapped market! <br> Hire anything or hire out everything you have, The choice is yours.</p>
				<div class="vendor-consumer-cards">
					<div class="card consumer-card">
						<h3>Consumer</h3>
						<p>As a consumer, you get to hire any equipments and services from other users and create memorable events with minimum effort with a price that is budget flexible.</p>
						<a href="" class="card-links">Sign Up</a>
					</div>
					<div class="card vendor-card">
						<h3>Vendor</h3>
						<p>As a vendor, other users(consumers) can hire items that you own from you. Upload equipments or services and we will help you get in business by letting others find you on our platform.</p>
						<a href="" class="card-links">Sign Up</a>
					</div>
				</div>
			</section>
		</article>
        <footer>
			<section>
				<ul class="footer-nav-links">
					<li><a href="" class="footer-nav-item">Home</a></li>
					<li><a href="" class="footer-nav-item">About Us</a></li>
					<li><a href="" class="footer-nav-item">Equipments</a></li>
					<li><a href="" class="footer-nav-item">Services</a></li>
					<li><a href="" class="footer-nav-item">Sign In</a></li>
					<li><a href="" class="footer-nav-item">Sign Up</a></li>
				</ul>
				<address>
					Any comments? <a href="mailto:webmaster@somedomain.com">
					Reach out</a>.<br>
					You may also want to visit us:<br>
					Evento Inc.<br>
					P.O BOX 235-00100,<br>
					Karen, NRB<br>
					KENYA
				</address>
			</section>
			<hr>
			<p>&copy Evento Inc, 2021</P>
		</footer>

        			
        		

	        	<div class="col border">
	        		{{-- Register --}}
	        		{{-- @include('auth.register') --}}
        		</div>
        	</div>

        	
        
       
        
    </body>
</html>
@endsection

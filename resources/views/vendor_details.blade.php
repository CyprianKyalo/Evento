<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento | Landing</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Suez+One&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    
</head>
<body>
    <header id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item nav-brand">
                    <a class="nav-link" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
                <li class="nav-item"><a href="{{route('activity')}}" class="nav-link">Activity</a></li>
                <li class="nav-item"><a href="{{route('products.index')}}" class="nav-link">Equipments</a></li>
                <li class="nav-item"><a href="{{route('services')}}" class="nav-link">Services</a></li>
                <!-- <img src="/uploads/avatars/{{Auth::user()->image}}" style="width: 50px; height: 50px; border-radius: 50%;"> -->

                <div class="dropdown nav-item">
                    <button class="dropbtn">{{Auth::user()->username}}</button>
                    <div class="dropdown-content">
                        <a href="{{route('view_profile')}}">Profile</a>
                        <a href="{{ route('logout') }}" style="" 
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </nav>
    </header>
    <main class="user-engagement-interface">
        <!-- <aside>
            <img src="/uploads/avatars/{{Auth::user()->image}}" class="profile-img profile-article-img">
            <ul id="aside-navigation">
                <li><a href="{{route('view_profile')}}" class="user-navigation">Profile</a></li>
                <li><a href="{{route('activity')}}" class="user-navigation">Activity</a></li>
                <li><a href="{{route('products.index')}}" class="user-navigation">Equipment</a></li>
                <li><a href="{{route('services')}}" class="user-navigation">Services</a></li>
            </ul>
        </aside> -->

        <article>
            @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
            </div>
            @endforeach
        @endif
        
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
        
            <!-- <nav > -->
                <ul class="user-mode-navigations">
                    <li><a href="{{route('activity')}}" class="interactive-links">Consumer</a></li>
                    <li><a href="{{route('vendor')}}" class="interactive-links">Vendor</a></li>
                </ul>
            <!-- </nav> -->
            <h1>Fill in your vendor details</h1>
            <section id="">
                <form class="vendor-info" action="{{route('update_vendor')}}" method="POST">
                    {{-- {{method_field('PUT')}} --}}
                    {{csrf_field()}}
                   <label for="fname">First Name</label>
                   <input type="text" name="fname" placeholder="First Name" value="{{Auth::user()->first_name}}" disabled style="cursor: not-allowed;">
                   <label for="lname">Last Name</label>
                   <input type="text" name="lname" placeholder="Last Name" value="{{Auth::user()->last_name}}" disabled style="cursor: not-allowed;">
                   <label for="location">Location</label>
                   <input type="text" name="location" placeholder="Location">
                   <label for="about_me">About You</label>
                   <textarea name="about_me" name="about_me" id="about_me" cols="70" rows="10" placeholder="Give an introduction about yourself..."></textarea>
                   <label for="pnumber">Phone Number</label>
                   <input type="number" name="pnumber" placeholder="+254700000000">

                   <button class="vendor-buttons">Submit</button>
                </form>
            </section>
        </article>
    </main>
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
</body>
</html>
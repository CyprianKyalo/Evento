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

            {{-- @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
            @endif --}}

            @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
            </div>
            @endforeach
            @endif

            <div class="col-sm-12">
                @if(session()->get('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                @endif
            </div>

            <!-- <nav id="user-mode-navigations"> -->
            <ul class="user-mode-navigations">
                <li><a href="{{route('activity')}}" class="interactive-links">Consumer</a></li>
                <li><?php
                    use Illuminate\Support\Facades\DB;

                    $ids = DB::table('vendor_details')
                                    ->select('user_id')
                                    ->get();
                
                    //Create an array of all the user_ids in the vendor_details table
                    $id_arr = array();
                    for ($i=0; $i < count($ids); $i++) { 
                        $id_arr[] = $ids[$i]->user_id;
                        
                    }
                    
                    //Check if the logged in user is in the vendors_details table
                    if(in_array(Auth::id(), $id_arr)){
                        ?><a href="{{route('products.create')}}" class="interactive-links">Vendor</a><?php
                    } else{
                        ?><a href="{{route('vendor_details')}}" class="interactive-links">Vendor</a><?php
                    }

                    //$ids = array('1', '2');

                    //if(in_array('4', $ids)) {
                        //return 1;
                        //  ?>{{-- <a href="{{route('products.create')}}" class="interactive-links">Vendor</a> --}}<?php
                    //} else {
                    //    ?>{{-- <a href="{{route('vendor_details')}}" class="interactive-links">Vendor</a> --}}<?php
                    //}
                ?></li>
            </ul>
            <!-- </nav> -->

            <h1>Welcome to your consumer mode.</h1>
            <h3>Here's where you can view all the items you have hired or bought after payment completion.</h3>

            <a href="{{route('pending')}}" class="btn btn-primary interactive-links">Pending</a>
            <a href="{{route('accepted')}}" class="btn btn-primary interactive-links">Accepted</a>
            <a href="{{route('declined')}}" class="btn btn-primary interactive-links">Declined</a>
            <a href="{{route('cancelled')}}" class="btn btn-primary interactive-links">Cancelled</a>
            <a href="{{route('history')}}" class="btn btn-primary interactive-links">History</a>

            <section id="consumer-items">



                @foreach($products as $product)
                <div class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><span><a href="{{route('products.show', $product->product_id)}}"><img src="/uploads/products/{{$product->image_path}}" alt=""></a></span></li>
                            <li><span class="card-info-labels">Equipment:</span> {{$product->name}}</li>
                             <li><span class="card-info-labels"></span> {{$product->description}}</li>
                              <li><span class="card-info-labels"></span><img src="/uploads/avatars/{{$product->image}}" alt="" style="width: 50px; height: 50px; border-radius: 50%"></li>
                            <li><span class="card-info-labels">by </span> <a href="{{route('vendor_profile', $product->id)}}">{{$product->username}}</a></li>
                        </ul>
                    </div>
                </div>
                
                @endforeach
                {{-- <a href="{{route('products.show')}}" class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><span class="card-info-labels">Equipment:</span> name</li>
                            <li><span class="card-info-labels">Vendor:</span> username</li>
                        </ul>
                    </div>
                </a>
                <a href="{{route('products.show')}}" class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><span class="card-info-labels">Equipment:</span> name</li>
                            <li><span class="card-info-labels">Vendor:</span> username</li>
                        </ul>
                    </div>
                </a> --}}
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
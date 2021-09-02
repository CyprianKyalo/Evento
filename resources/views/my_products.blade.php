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

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Suez+One&display=swap" rel="stylesheet">
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
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        <br>
        @endif


    <div class="col-sm-12">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
        @endif
    </div>
            <h1>My products</h1>
            <section id="item-equipment">
                
                {{-- <a href="{{route('products.edit', $product->product_id)}}" class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><img src="/uploads/products/{{$product->image_path}}" alt=""></li>
                            <li><span class="card-info-labels">Equipment:</span> {{$product->name}}</li>
                            
                        </ul>
                    </div>
                </a> --}}

                <table class="table table-striped" style="text-align: center;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            
                        </tr>
                    </thead>
                    
                    @foreach($products as $product)
                    <tbody>
                        <tr>
                            <td><img src="/uploads/products/{{$product->image_path}}" alt="" style="width: 100px; height: 80xp"></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->price}}</td>
                            <td><a href="{{route('products.edit', $product->product_id)}}" class="btn btn-primary" id="edit_prod">Edit</a></td>
                            <form action="{{route('products.destroy', $product->product_id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete the product?');">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                            </form>                      
                        </tr>
                    </tbody>
                    
                    @endforeach
                </table>
                {{-- @endforeach --}}
            </section>
        </article>
    </main>


    <script>
        document.getElementById('delete').addEventListener('click', (event) => {
            event.preventDefault();

            alert('Are you sure you want to?');
        });
    </script>


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
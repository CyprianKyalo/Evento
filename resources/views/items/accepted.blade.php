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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
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
        }

        #profile-activity {
            display: flex;
            padding: 20px;
            width: 90%;
        }

        /* equipments and services */
        #item-equipment {
            display: flex;
            flex-wrap: wrap;
            padding-top: 80px;
        }

        .card-link {
            text-decoration: none;
            width: 30%;
            margin-right: auto;
            margin-left: auto;
        }

        .card {
            border: 1px solid #ccc;
            width: 100%;
            text-align: center;
        }

        .card:hover {
            border: 1px solid #000;
        }

        .card ul {
            padding: 0;
            display: inline-block;
        }

        .card ul li {
            list-style: none;
            display: block;
            padding: 10px;
            color: #000;
        }

        /* consumer */
        #user-mode-navigations {
            padding: 30px;
        }

        #user-mode-navigations ul {
            padding: 0;
        }

        #user-mode-navigations ul li {
            list-style: none;
            display: inline-block;
        }

        #user-mode-navigations ul li a {
            text-decoration: none;
        }

        article h1 {
            margin: 15px 0;
            padding-left: 20px;
        }

        article h3 {
            margin: 15px 0;
            padding-left: 20px;
        }

        #consumer-items {
            display: flex;
            flex-wrap: wrap;
            padding-top: 80px;
        }

        /* Dropdown Button */
        .dropbtn {
          background-color: #04AA6D;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
          position: relative;
          display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #ddd;}

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {display: block;}

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {background-color: #3e8e41;}
    </style>
</head>
<body>
    <header>
        <ul>
            <img src="/uploads/avatars/{{Auth::user()->image}}" style="width: 50px; height: 50px; border-radius: 50%;">

            <div class="dropdown">
                <button class="dropbtn">{{Auth::user()->username}}</button>
                <div class="dropdown-content">
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
    </header>

    <main>
        <aside>
            <img src="/uploads/avatars/{{Auth::user()->image}}" class="profile-img profile-article-img">
            <ul id="aside-navigation">
                <li><a href="{{route('view_profile')}}" class="user-navigation">Profile</a></li>
                <li><a href="{{route('activity')}}" class="user-navigation">Activity</a></li>
                <li><a href="{{route('products.index')}}" class="user-navigation">Equipment</a></li>
                <li><a href="{{route('services')}}" class="user-navigation">Services</a></li>
            </ul>
        </aside>
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

            <nav id="user-mode-navigations">
                <ul>
                    <li><a href="{{route('activity')}}">Consumer</a></li>
                    <li>/</li>
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
                           ?><a href="{{route('products.create')}}">Vendor</a><?php
                        } else{
                            ?><a href="{{route('vendor_details')}}">Vendor</a><?php
                        }

                    ?></li>
                </ul>
            </nav>

            <h1>Accepted Offers</h1>
            {{-- <h3>Here's where you can view all the items you have hired or bought after payment completion.</h3> --}}

            <a href="{{route('pending')}}" class="btn btn-primary">Pending</a>
            <a href="{{route('accepted')}}" class="btn btn-primary">Accepted</a>
            <a href="{{route('declined')}}" class="btn btn-primary">Declined</a>
            <a href="{{route('cancelled')}}" class="btn btn-primary">Cancelled</a>

            <section id="consumer-items">



                
                {{-- <div class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><span><a href="{{route('products.show', $product->product_id)}}"><img src="/uploads/products/{{$product->image_path}}" alt=""></a></span></li>
                            <li><span class="card-info-labels">Equipment:</span> {{$product->name}}</li>
                             <li><span class="card-info-labels"></span> {{$product->description}}</li>
                              <li><span class="card-info-labels"></span><img src="/uploads/avatars/{{$product->image}}" alt="" style="width: 50px; height: 50px; border-radius: 50%"></li>
                            <li><span class="card-info-labels">by </span> <a href="{{route('vendor_profile', $product->id)}}">{{$product->username}}</a></li>
                        </ul>
                    </div>
                </div> --}}

                    <?php $total_price = 0;?>


                    <table class="table">
                      <thead style="text-align: center;">
                        <tr>
                          <th scope="col">Image</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Vendor</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Hired On</th>
                          <th scope="col">Hire ending at</th>
                          <th scope="col">Duration</th>
                          <th scope="col">Total Price</th>
                          
                        </tr>
                      </thead>
                      @foreach($products as $product)
                      <tbody style="text-align: center;">
                        <tr>
                          <th scope="row"><img src="/uploads/products/{{$product->image_path}}" alt="" style="width: 100px; height: 100px"></th>
                          <td>{{$product->name}}</td>
                          <td>{{$product->username}}</td>
                          <td>{{$product->pnumber}}</td>
                          <td>{{$product->hired_at}}</td>
                          <td>{{$product->hired_ended_at}}</td>
                          <td>{{$product->duration}}</td>
                          <td>Ksh. {{$product->total_price}}</td>

                          <?php $total_price += $product->total_price?>

                          {{-- <form action="{{route('hire', $product->product_id)}}" method="GET">
                            {{csrf_field()}}
                            <input type="text" hidden value="{{$product->product_id}}" name="id">
                            <td><a href="{{route('hire', $product->product_id)}}" class="btn btn-primary">Edit</a></td>
                            <td><button class="btn btn-primary">Edit</button></td>
                            
                            </form>
                          
                          <td><a href="#" class="btn btn-danger">Cancel</a></td> --}}
                        </tr>
                      </tbody>
                      @endforeach
                      <tfoot style="text-align: center;">
                          <tr>
                              <td style="font-size: 25px; ">Total</td>
                               <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td style="font-size: 25px">Ksh. <?php echo number_format((float)$total_price, 2, '.', '');?></td>
                          </tr>
                      </tfoot>
                    </table>                
                

            </section>
        </article>
    </main>
    <footer>
        <p>&copy2021 Evento, Inc.</p>
    </footer>
</body>
</html>
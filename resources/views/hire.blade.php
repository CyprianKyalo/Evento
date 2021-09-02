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

        /* vendor */
        #vendor-item-description {
            border: 1px solid #ccc;
            margin-left: 10px;
        }

        .vendor-buttons {
            display: inline-block;
            width: 20%;
            margin-left: 9px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 0;
        }

        .vendor-buttons:hover {
            background-color: #fff;
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
        
            <h1>Hire Product</h1>

            <section id="consumer-items">
                <form class="vendor-info" action="{{route('hire_product')}}" method="POST">
                    {{csrf_field()}}
                    {{-- {{method_field('PUT')}} --}}

                    
                    <label for="date_of_hire" style="margin: 10px;">Date of Hire</label>
                    <input type="date" name="date_of_hire" id="date_of_hire">

                    <label for="start_time">Choose the start time</label>
                    <input type="time" name="start_time" id="start_time">

                    <label for="end_date">End Date of Hire</label>
                    <input type="date" name="end_date" id="end_date">

                    <label for="end_time">Choose the completion time</label>
                    <input type="time" name="end_time" id="end_time">

                    <label for="location">Location</label>
                    <input type="text" name="location" placeholder="E.g. Kawangware, Nairobi">

                    <label for="phone_number">Phone Number</label>
                    <input type="tel" name="phone_number" placeholder="E.g. 0712345678">

                    <label for="other">Additional Order Information</label>
                    <textarea name="other" id="vendor-item-description" cols="71.9" rows="10" placeholder="Additional Information"></textarea>


                    <input type="text" hidden value="{{$price}}" id="item_price">
                    <h4 id="price">Ksh. {{$price}}</h4>
    
                    {{-- <label for="description" style="margin: 10px;">Duration</label>
                    <input type="text" name="duration" placeholder="Eg. 5 Hours, 2 Days" id="duration">
 --}}
                    <h4 id="dur"></h4>
                    <input type="text" id="duration" name="duration" value="" hidden>
                    <input type="text" name="start" id="start" value="" hidden>
                    <input type="text" name="end" id="end" value="" hidden>
                    <input type="text" name="total_price" id="total_price" value="" hidden>


                    <button id="generate">Generate Duration</button>

                    <input type="text" hidden value="{{$product->product_id}}" name="id">

                    {{-- <form action="">
                        {{csrf_field()}}
                        {{method_field('PATCH')}} --}}
                        <button class="vendor-buttons">Hire</button>         
                    {{-- </form> --}}

                    {{-- <form action="{{route('products.destroy', $product->product_id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}

                        <button class="vendor-buttons">Delete</button>
                    </form> --}}

                    {{-- <button type="button" class="btn btn-danger productdeletebtn">Delete</button> --}}

                </form>
            </section>
        </article>
    </main>

    <script>
        document.getElementById('generate').addEventListener('click', (event) => {
        
            event.preventDefault();

            var startDate = document.getElementById('date_of_hire').value;
            var startTime = document.getElementById('start_time').value;

            var endDate = document.getElementById('end_date').value;
            var endTime = document.getElementById('end_time').value;
      
            const start = new Date(startDate + ' ' + startTime);
            const end = new Date(endDate + ' ' + endTime);
            
            var duration = Math.abs(end - start);
            var minutes = duration/60000;
            var hours = minutes/60;

            var itprice = document.getElementById('item_price').value;
            var totprice = itprice * hours;

            var starting = document.getElementById('start').value = startDate + ' ' + startTime;
            var ending = document.getElementById('end').value = endDate + ' ' + endTime;

            if (start > end) {
                alert('Start time cannot be greater than end time');
            } else {
                var totprice = totprice.toFixed(2);
                document.getElementById('price').innerHTML = 'Ksh. ' + totprice;

                document.getElementById('total_price').value = totprice;

                var hours = hours.toFixed(2);
                document.getElementById('dur').innerHTML = hours + ' hours'; 

                document.getElementById('duration').value = hours + ' hours'; 
            }

        });
      
    </script>


    <footer>
        <p>&copy2021 Evento, Inc.</p>
    </footer>
</body>
</html>
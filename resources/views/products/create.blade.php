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
    </style>
</head>
<body>
    <header>
        <ul>
            <li><a href="#">Logout</a></li>
        </ul>
    </header>
    <main>
        <aside>
            <img src="https://via.placeholder.com/150" alt="user profile" class="profile-img profile-aside-img">
            <ul id="aside-navigation">
                <li><a href="{{route('view_profile')}}" class="user-navigation">Profile</a></li>
                <li><a href="{{route('activity')}}" class="user-navigation">Activity</a></li>
                <li><a href="{{route('products.index')}}" class="user-navigation">Equipment</a></li>
                <li><a href="{{route('services')}}" class="user-navigation">Services</a></li>
            </ul>
        </aside>
        <article>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
            </div>
            @endforeach
        @endif
        <br>

            <nav id="user-mode-navigations">
                <ul>
                    <li><a href="{{route('activity')}}">Consumer</a></li>
                    <li>/</li>
                    <li><a href="{{route('products.create')}}">Vendor</a></li>
                </ul>
            </nav>
            <h1>Welcome to your vendor mode.</h1>
            <h3>Here's where you can hire out or sell items you have to other customers.</h3>
            <section id="consumer-items">
                <form class="vendor-info" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="text" placeholder="Item/Service name" name="name">
                    <textarea name="description" id="vendor-item-description" cols="71.9" rows="10" placeholder="description" name="description"></textarea>

                    <label for="Category">Choose a category</label>
                    <select name="category" id="category">
                        <option value="equipment">Equipment</option>
                        <option value="service">Service</option>
                    </select>

                    <input type="number" name="price" placeholder="Price">

                    <label for="Status">Choose the product's status</label>
                    <select name="status" id="category">
                        <option value="tohire">To Hire</option>
                        <option value="tosell">To Sell</option>
                    </select>
                    <br>

                    <label for="item-image" style="margin: 10px;">Item/Service Image</label>
                    <input type="file" name="item-image" id="">

                    {{-- <input type="submit" > --}}
                    <button class="vendor-buttons">Upload</button>
                    {{-- <button class="vendor-buttons"><a href="{{route('activity')}}"></a>Back</button> --}}
                </form>
            </section>
        </article>
    </main>
    <footer>
        <p>&copy2021 Evento, Inc.</p>
    </footer>
</body>
</html>
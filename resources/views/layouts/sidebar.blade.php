<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
        }

        p{
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.7em;
            color: #999;
        }

        a, a:hover, a:focus{
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        /*Side Bar*/
        .wrapper{
            display: flex;
            text-decoration: none;
            transition: all 0.3s;
        }

        #sidebar{
            min-width: 250px;
            max-width: 250px;
            background: #7386D5;
            color: #fff;
        }

        #sidebar .active{
            margin-left: -250px;
        }

        #sidebar .sidebar-header{
            padding: 20px;
            background: #6d7fcc;
        }

        #sidebar ul.components{
            padding: 20px;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul p{
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a{
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a:hover{
            color: #7386D5;
            background: #fff;
        }

        #sidebar ul li.active>a, a[aria-expanded="true"] {
            color: #fff;
            background: #6d7fcc;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after{
            display: block;
            position: absolute;
            top: 50%;
            right: 20%;
            transform: translate(-50%);
        }

        ul ul a{
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #6d7fcc;
        }

        #content{
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transform: all 0.3s;
        }

    </style>
</head>

<body>
    <div class="wrapper">

        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>Navigation</h3>
            </div>

            <ul class="lisst-unstyled components">
                <p>The Providers</p>
                <li class="active">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false">Home</a>
                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">Products</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false">Pages</a>
                    <ul>
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="btn btn-info" id="sidebarCollapse">
                        <i class="fa fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                </div>
            </nav>
        </div>
        {{-- <main>
            @yield('content')
        </main> --}}
    </div>
    

    <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
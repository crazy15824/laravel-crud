<html>

<head>
    <title>App Name - @yield('title')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
        rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<script>$(document).ready(function() {
    $('#pTable').DataTable();
});</script>
    <style> 
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #9C27B0;
            color: white;
            text-align: center;
        }
        body {
            background-color:  #EDF7EF
        }
        .container .dataTables_wrapper .dataTables_length,
        .container .dataTables_wrapper .dataTables_info,
        .container .dataTables_wrapper .dataTables_paginate {
            display: none!important;
        }
        .container .dataTables_wrapper {
            padding-bottom: 30px;
        }
        #dashboard_number {
            list-style-type: disc;
        }
        #dashboard_number li {
            list-style-type: none;
            font-size: 50px;
            color: blue;
        }
        .paginations nav {
            display: none;
        }

    </style>

</head>

<body>
    @section('sidebar')

    @show
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            @guest
            <a style="padding: 0 15px" class="navbar-brand mr-auto" href="/login">SWIPE</a>
            <a style="padding: 0 15px" class="navbar-brand mr-auto" href="/login">DASHBOARD</a>
            @else
            <a style="padding: 0 15px" class="navbar-brand mr-auto" href="/dashboard/templates">SWIPE</a>
            <a style="padding: 0 15px" class="navbar-brand mr-auto" href="/dashboard">DASHBOARD</a>
            @endguest
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
        @guest
        <div class="row" style="padding: 30px;"></div>
        <div class="row" style="padding: 30px;">
            <div class="row col-lg-12 margin-tb">
                <div class="pull-right col-6">
                    <a class="btn btn-success" href="{{ route('login') }}" title="Create a templates">QUICK SWIPE</a>
                </div>
                <div class="pull-right col-6">
                    <a class="btn btn-success" href="{{ route('login') }}" title="Create a templates">NORMAL SWIPE</a>
                </div>
            </div>
        </div> 
        @else
        <div class="row" style="padding: 30px;">
            <div class="row col-lg-12 margin-tb">
                <div class="pull-right col-6">
                    <a class="btn btn-success" href="{{ route('templates.create') }}" title="Create a templates">QUICK SWIPE</a>
                </div>
                <div class="pull-right col-6">
                    <a class="btn btn-success" href="{{ route('templates.create') }}" title="Create a templates">NORMAL SWIPE</a>
                </div>
            </div>
        </div> 
        @endguest
    </nav>
        @yield('dashboard')
    @guest
    <div>
        @yield('content')
    </div>
    @else
    <div class="col-8 paginations" style="margin: 0 auto;">
        @yield('satisfy')
    </div>
    @endguest
    
</body>

</html>

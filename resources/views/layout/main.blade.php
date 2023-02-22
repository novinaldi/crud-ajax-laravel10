<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD Ajax Jquery</title>
    <link href="{{ asset('/') }}assets/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('/') }}assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/plugins/datatable/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/plugins/datatable/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/plugins/izitoast/css/iziToast.min.css" rel="stylesheet">

    <script src="{{ asset('/') }}assets/js/jquery-3.6.3.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/izitoast/js/iziToast.min.js"></script>
</head>

<body>

    <div>
        <div class="sidebar p-4 bg-dark active-sidebar shadow text-dark" id="sidebar">
            <h4 class="mb-5 text-white">Laravel 10</h4>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment('1') == '' || request()->segment('1') == 'home' ? 'active' : 'text-secondary' }}"
                        href="{{ url('home') }}">
                        <i class="fas fa-tachometer-alt"></i>&nbsp;
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment('1') == 'customer' ? 'active' : 'text-secondary' }}"
                        href="{{ url('customer') }}">
                        <i class="fas fa-user"></i>&nbsp;
                        <span class="text">Customer</span>
                    </a>
                </li>
            </ul>
            {{--  --}}
        </div>
    </div>

    <section class="active-main-content" id="main-content">
        <nav class="navbar navbar-expand-sm bg-default navbar-light shadow">
            <div class="container-fluid">
                <button class="btn btn-primary" id="button-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>

        <div class="card mt-5 mx-2">
            @yield('content')
        </div>
    </section>

    <script src="{{ asset('/') }}assets/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        // event will be executed when the toggle-button is clicked
        document.getElementById("button-toggle").addEventListener("click", () => {

            // when the button-toggle is clicked, it will add/remove the active-sidebar class
            document.getElementById("sidebar").classList.toggle("active-sidebar");

            // when the button-toggle is clicked, it will add/remove the active-main-content class
            document.getElementById("main-content").classList.toggle("active-main-content");
        });
    </script>
</body>

</html>

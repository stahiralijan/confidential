<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="/favicon.png">

    <link rel="stylesheet" href="/vendor/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/select2/css/select2.css">
    <link rel="stylesheet" href="/vendor/datepicker-1.0.9/dist/datepicker.min.css">
    <link rel="stylesheet" href="/vendor/bootstrap4-toggle/css/bootstrap4-toggle.min.css">
    <link rel="stylesheet" href="/vendor/sweetalert2/sweetalert2.min.css">
    <link href="/vendor/datatable/datatables.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
        .bigdrop {
            width:300px !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/logo-sig.png" alt="PESCO Enquiry Information System" width="75">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <button type="button" id="navbarDropdown" class="nav-link dropdown-toggle btn btn-default" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <button class="dropdown-item btn btn-danger"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</button>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" style="max-width: 95%">
            <div class="row" style="padding:35px 0">
                @auth
                <aside class="col-md-2">
                    @include('layouts.sidebar')
                </aside>
                @endauth
                @yield('content')
            </div>
        </div>
        {!! Notify::render() !!}
    </div>
    <script src="/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="/vendor/bootstrap-4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/datatable/datatables.js"></script>
    <script src="/vendor/select2/js/select2.full.min.js"></script>
    <script src="/vendor/datepicker-1.0.9/dist/datepicker.min.js"></script>
    <script src="/vendor/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
    <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/vendor/jquery-validate/jquery.validate.min.js"></script>
    <script src="/vendor/inputmask/jquery.inputmask.js"></script>
    <script>
        $(document).ready(()=>{
            $('.dropdown-toggle').dropdown()
        })
    </script>
    @stack('scripts')
</body>
</html>

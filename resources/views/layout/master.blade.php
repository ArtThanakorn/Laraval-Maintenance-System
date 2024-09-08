<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MaintenanceSystem - Admin</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <link href="/css/sidebar.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
    <!-- Include Parsley.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <!-- Data Table CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">

    <!--  datatables js -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">


    <script>
        var $url = {!! json_encode(url('/')) !!};
    </script>

    @yield('style')
</head>

<body class="sb-nav-fixed">
    {{--  <nav class="sb-topnav navbar navbar-expand navbar-light">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3"
            @if (Auth::user()->role === 1) href="{{ route('admin.dashdoard') }}"
           @elseif (Auth::user()->role === 2)
           href="{{ route('technician.dashboard') }}"
           @else
           href="{{ route('index.repair') }}" @endif><i class="fa fa-wrench" aria-hidden="true" style="color: red; font-size: 16px;"></i> Maintenance System</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

            </li>
        </ul>
    </nav>  --}}

    <div id="layoutSidenav">
        @include('layout.sidebar2')
        {{--  <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 my-4 ">
                    @yield('content')
                </div>
            </main>
        </div>  --}}
    </div>
    @yield('script')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </script>
    <script src="/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!--  datatables -->
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <!-- Data Table JS -->
    <script src='https://code.jquery.com/jquery-3.7.1.js'></script>
    <script src='https://cdn.datatables.net/2.0.3/js/dataTables.js'></script>

    <script src="/js/sidebar.js"></script>


</body>

</html>

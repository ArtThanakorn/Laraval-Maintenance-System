<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MaintenanceSystem - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
    <!-- Data Table JS -->
    <script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>
    @yield('style')
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Maintenance System</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        {{--  เริ่มเมนูแอดมิน  --}}
                        <div class="sb-sidenav-menu-heading">เมนู แอดมิน</div>
                        <a class="nav-link" href="{{ url('/admin/repair') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bullhorn text-info"></i></div>
                            แจ้งซ่อม
                        </a>
                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars-staggered text-danger"></i></div>
                            ดูรายการเเจ้งซ่อม
                        </a>
                        <a class="nav-link" href="{{ url('/admin/comfirmRepair') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars-staggered text-danger"></i></div>
                            หน้ายืนยันการเเจ้งซ่อม
                        </a>
                        <a class="nav-link" href="{{ url('/employee') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user text-info"></i></div>
                            จัดการข้อมูลแอดมิน
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-user text-success"></i></div>
                            จัดการข้อมูลพนักงาน
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-user text-warning"></i></div>
                            จัดการข้อมูลช่าง
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-calendar-check text-info"></i></div>
                            จัดการข้อมูลสถาณะ
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-address-book text-info"></i></div>
                            ข้อมูลส่วนตัว
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-database text-info"></i></div>
                            รายงาน
                        </a>
                        <div class="sb-sidenav-menu-heading">ออกจากระบบ</div>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out text-danger"></i></div>
                            ออกจากระบบ
                        </a>
                        {{--  สิ้นสุดเมนูแอดมิน  --}}

                        {{--  เริ่มเมนูช่าง  --}}
                        <div class="sb-sidenav-menu-heading">เมนู ช่าง</div>
                        <a class="nav-link" href="{{ url('/technician/dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-tachometer text-info"></i></div>
                            ดูงานเเจ้งซ่อม
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars-staggered text-info"></i></div>
                            จัดการงานซ่อม
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars-staggered text-info"></i></div>
                            เเจ้งซ่อมเสร็จเเล้ว
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-address-book text-info"></i></div>
                            ข้อมูลส่วนตัว
                        </a>
                        <div class="sb-sidenav-menu-heading">ออกจากระบบ</div>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out text-danger"></i></div>
                            ออกจากระบบ
                        </a>
                        {{--  สิ้นสุดเมนูช่าง  --}}

                        {{--  เริ่มเมนู พนักงาน  --}}
                        <div class="sb-sidenav-menu-heading">เมนู พนักงาน</div>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-tachometer text-info"></i></div>
                            ดูงานเเจ้งซ่อม
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-bullhorn text-info"></i></div>
                            เเจ้งปัญหางาน
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars-staggered text-info"></i></div>
                            รายงานเเจ้งซ่อม
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-address-book text-info"></i></div>
                            ข้อมูลส่วนตัว
                        </a>
                        <div class="sb-sidenav-menu-heading">ออกจากระบบ</div>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out text-danger"></i></div>
                            ออกจากระบบ
                        </a>
                        {{--  สิ้นสุดเมนูพนักงาน  --}}
                    </div>
                </div>
                {{--  <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>  --}}
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>
            {{--  <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>  --}}
        </div>

    </div>
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>

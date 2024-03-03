<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @auth
                    {{--  เริ่มเมนูแอดมิน  --}}
                    @if (Auth::user()->role === 1)
                        <div class="sb-sidenav-menu-heading">เมนู หลัก</div>
                        <a class="nav-link" href="{{ route('admin.dashdoard') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-home text-info"></i></div>
                            หน้าหลัก
                        </a>
                        <a class="nav-link" href="{{ route('index.repair') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-wrench text-info"></i></div>
                            แจ้งซ่อม
                        </a>
                        <a class="nav-link" href="{{route('repair.followUp')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-tasks text-info"></i></div>
                            ติดตามการแจ้งซ่อม
                        </a>
                        <a class="nav-link" href="{{ route('show.repair') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-pie-chart text-danger"></i></div>
                            รายการเเจ้งซ่อม
                        </a>
                        <a class="nav-link" href="{{ route('pages.addadmin') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user text-info"></i></div>
                            จัดการข้อมูลแอดมิน
                        </a>
                        <a class="nav-link" href="{{route('technician.index')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user text-success"></i></div>
                            จัดการข้อมูลช่าง
                        </a>
                        <a class="nav-link" href="{{route('D.index')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-user text-warning"></i></div>
                            จัดการข้อมูลแผนก
                        </a>
                        {{--  <a class="nav-link" href="">
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
                        </a>  --}}
                        <div class="sb-sidenav-menu-heading">ออกจากระบบ</div>
                        <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out text-danger"></i></div>
                            ออกจากระบบ
                        </a>
                    @endif
                    {{--  สิ้นสุดเมนูแอดมิน  --}}

                    {{--  เริ่มเมนูช่าง  --}}
                    @if (Auth::user()->role === 2)
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
                    @endif
                    {{--  สิ้นสุดเมนูช่าง  --}}

                    {{--  เริ่มเมนู พนักงาน  --}}
                    {{-- <div class="sb-sidenav-menu-heading">เมนู พนักงาน</div>
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
                </a> --}}
                    {{--  สิ้นสุดเมนูพนักงาน  --}}
                @endauth
            </div>
        </div>
        {{--  <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>  --}}
    </nav>
</div>

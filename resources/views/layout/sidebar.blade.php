<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @auth
                    @if (Auth::user()->role === 1)
                        <div class="sb-sidenav-menu-heading">เมนู หลัก</div>
                        <a class="nav-link" href="{{ route('admin.dashdoard') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-home text-info"></i></div>
                            หน้าหลัก
                        </a>
                        <a class="nav-link" href="{{route('repair.followUp')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-tasks text-info"></i></div>
                            ติดตามการแจ้งซ่อม
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-pie-chart text-danger"></i></div>
                            รายการเเจ้งซ่อม
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('show.repair',['p'=>10,'status'=>'ทั้งหมด']) }}">ทั้งหมด</a>
                                <a class="nav-link" href="{{ route('show.repair',['p'=>10,'status'=>'รอดำเนินการ'] )}}">รอดำเนินการ</a>
                                <a class="nav-link" href="{{ route('show.repair',['p'=>10,'status'=>'ดำเนินการเสร็จสิ้น'])}}">ดำเนินการเสร็จสิ้น</a>
                            </nav>
                        </div>

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
                        {{--  <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out text-danger"></i></div>
                            ออกจากระบบ
                        </a>  --}}

                    @endif
                    {{--  สิ้นสุดเมนูแอดมิน  --}}

                    {{--  เริ่มเมนูช่าง  --}}
                    @if (Auth::user()->role === 2)
                        <div class="sb-sidenav-menu-heading">เมนู ช่าง</div>
                        <a class="nav-link" href="{{ route('technician.listwork', ['p' => 10]) }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-pie-chart text-danger"></i></div>
                            ดูรายการเเจ้งซ่อม
                        </a>
                        <a class="nav-link" href="{{ route('technician.info') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-users text-info"></i></div>
                            ข้อมูลส่วนตัว
                        </a>
                        <div class="sb-sidenav-menu-heading">ออกจากระบบ</div>

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
                        <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out text-danger"></i></div>
                            ออกจากระบบ
                        </a> --}}
                    {{--  สิ้นสุดเมนูพนักงาน  --}}
                @endauth

            </div>
        </div>
        <div class="sb-sidenav-footer">
                <div class="small">{{Auth::user()->name}}</div>
                    <div>
                        <a class="nav-link" href="{{ route('logout') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out text-danger"></i> ออกจากระบบ</div>
                        </a>
                    </div>
        </div>
    </nav>
</div>

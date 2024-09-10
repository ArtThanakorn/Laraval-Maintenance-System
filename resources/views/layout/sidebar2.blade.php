@auth
    @if (Auth::user()->role === 1)
        <div class="sidebar close">
                <div class="logo-details">
                    <i class='bx bx-cog'></i>
                    <span class="logo_name">Maintenance System</span>
                </div>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('admin.dashdoard') }}">
                    <i class='bx bx-grid-alt' ></i>
                    <span class="link_name">หน้าหลัก</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('admin.dashdoard') }}">หน้าหลัก</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('repair.followUp')}}">
                    <i class='bx bx-list-ul' ></i>
                    <span class="link_name">ติดตามการแจ้งซ่อม</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{route('repair.followUp')}}">ติดตามการแจ้งซ่อม</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                    <a href="{{ route('show.repair',['p'=>10,'status'=>'ทั้งหมด']) }}">
                        <i class='bx bx-collection' ></i>
                        <span class="link_name">รายการแจ้งซ่อม</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow' ></i>
                    </div>
                    <ul class="sub-menu">
                    <li><a class="link_name" href="#">รายการแจ้งซ่อม</a></li>
                    <li><a href="{{ route('show.repair',['p'=>10,'status'=>'ทั้งหมด']) }}">ทั้งหมด</a></li>
                    <li><a href="{{ route('show.repair',['p'=>10,'status'=>'รอดำเนินการ'] )}}">รอดำเนินการ</a></li>
                    <li><a href="{{ route('show.repair',['p'=>10,'status'=>'ดำเนินการเสร็จสิ้น'])}}">ดำเนินการเสร็จสิ้น</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('pages.addadmin') }}">
                    <i class='bx bx-user' ></i>
                    <span class="link_name">จัดการข้อมูลแอดมิน</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('pages.addadmin') }}">จัดการข้อมูลแอดมิน</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('technician.index')}}">
                    <i class='bx bx-user' ></i>
                    <span class="link_name">จัดการข้อมูลช่าง</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{route('technician.index')}}">จัดการข้อมูลช่าง</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('D.index')}}">
                    <i class='bx bxs-user-account'></i>
                    <span class="link_name">จัดการข้อมูลแผนก</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{route('D.index')}}">จัดการข้อมูลแผนก</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('R.index') }}">
                    <i class='bx bx-window-open'></i>
                    <span class="link_name">ห้อง</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('R.index') }}">ห้อง</a></li>
                    </ul>
                </li>

                <li>
                    <div class="profile-details">
                    <div class="profile-content">
                        <img src="https://www.venmond.com/demo/vendroid/img/avatar/big.jpg" alt="profileImg">

                    </div>
                    <div class="name-job">
                        <div class="profile_name"><div class="small">{{Auth::user()->name}}</div></div>
                    </div>
                    <a class="nav-link" href="{{ route('logout') }}">
                        <div class="sb-nav-link-icon"><i class="bx bx-log-out text-white"></i></div>
                    </a>
                    </div>
                </li>
            </ul>
            @endif

            @if (Auth::user()->role === 2)
            <div class="sidebar close">
                <div class="logo-details">
                    <i class='bx bx-cog'></i>
                    <span class="logo_name">Maintenance System</span>
                </div>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('technician.dashboard') }}">
                    <i class='bx bx-grid-alt' ></i>
                    <span class="link_name">หน้าหลัก</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('technician.dashboard') }}">หน้าหลัก</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('technician.info') }}">
                    <i class='bx bxs-user-account'></i>
                    <span class="link_name">ข้อมูลส่วนตัว</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('technician.info') }}">ข้อมูลส่วนตัว</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('T.Staff') }}">
                    <i class='bx bx-user' ></i>
                    <span class="link_name">จำนวนช่างในแผนก</span>
                    </a>
                    <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('T.Staff') }}">จำนวนช่างในแผนก</a></li>
                    </ul>
                </li>


                <li>
                    <div class="profile-details">
                    <div class="profile-content">
                        <img src="https://www.venmond.com/demo/vendroid/img/avatar/big.jpg" alt="profileImg">

                    </div>
                    <div class="name-job">
                        <div class="profile_name"><div class="small">{{Auth::user()->name}}</div></div>
                    </div>
                    <a class="nav-link" href="{{ route('logout') }}">
                        <div class="sb-nav-link-icon"><i class="bx bx-log-out text-white"></i></div>
                    </a>
                    </div>
                </li>
            </ul>
            @endif
            @endauth
        </div>
        <section class="home-section">
            <div class="home-content">
                <i class='bx bx-menu' ></i>
                {{--  <span class="text">หน้าหลัก</span>  --}}
                <div class="container-fluid px-4 my-4 ">
                    @yield('content')
                </div>
            </div>
        </section>




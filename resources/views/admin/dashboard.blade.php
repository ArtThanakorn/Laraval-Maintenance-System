@extends('layout.master')

@section('content')
    <script>
        // Initialization for ES Users
        import {
            Ripple,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Ripple
        });
    </script>
    <div class="container-fluid px-4">
        <h1 class="mt-4">หน้าหลัก</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">ข้อมูลต่างๆ</li>
        </ol>
        <section>
            <!-- cards -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-10 col-md-8 col-lg-9 ml-auto">
                        <div class="row pt-md-7 mt-md-3 mb-5">

                            <div class="col-xl-3 col-sm-6 p2">
                                <div class="card card-common">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fa fa-users fa-3x text-info"></i>
                                            <div class="text-right text-secondary">
                                                <h5>จำนวนแอดมิน</h5>
                                                <h3>{{$countAdmin}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <a class="small text-white stretched-link" href="{{ route('pages.addadmin') }}"></a>
                                        <i class="fa fa-arrow-circle-right mr-3"></i>
                                        <span>ข้อมูลเพิ่มเติม</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 p2">
                                <div class="card card-common">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fa fa-users fa-3x text-warning"></i>
                                            <div class="text-right text-secondary">
                                                <h5>จำนวนนายช่าง</h5>
                                                <h3>{{$countTechnician}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <a class="small text-white stretched-link" href="{{ route('technician.index') }}"></a>
                                        <i class="fa fa-arrow-circle-right mr-3"></i>
                                        <span>ข้อมูลเพิ่มเติม</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 p2">
                                <div class="card card-common">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fa fa-users fa-3x text-success"></i>
                                            <div class="text-right text-secondary">
                                                <h5>แผนก</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <a class="small text-white stretched-link" href="{{ route('D.index')}}"></a>
                                        <i class="fa fa-arrow-circle-right mr-3"></i>
                                        <span>ข้อมูลเพิ่มเติม</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 p2">
                                <div class="card card-common mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <i class="fa fa-pie-chart fa-3x text-danger"></i>
                                            <div class="text-right text-secondary">
                                                <h5>จำนวนเเจ้งซ่อม</h5>
                                                <h3>{{ $countRepair }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary">
                                        <a class="small text-white stretched-link" href="{{ route('show.repair') }}"></a>
                                        <i class="fa fa-arrow-circle-right mr-3"></i>
                                        <span>ข้อมูลเพิ่มเติม</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of cards -->
            <h3 class="mt-4">รายชื่อผู้ปฎิบัติงาน</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">ข้อมูลต่างๆ</li>
            </ol>
            <div class="row">
                <div class="col-xl-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">ข้อมูลรายละเอียดช่าง</p>
                                        <p class="fw-bold mb-1">นายสาวสายฝน เเสงเนดร</p>
                                        <p class="text-muted mb-0">หัวหน้างานบริการทั่วไป</p>
                                        <p class="text-muted mb-0">เบอร์ : 062386xxxx</p>
                                    </div>
                                </div>
                                <span class="badge rounded-pill badge-success">Active</span>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">
                            <a class="btn btn-link m-0 text-reset" href="#" role="button" data-ripple-color="primary"
                                data-mdb-ripple-init>ตารางงาน<i class="fa fa-comments ms-2"></i></a>
                            <a class="btn btn-link m-0 text-reset" href="#" role="button" data-ripple-color="primary"
                                data-mdb-ripple-init>เลือกช่าง<i class="fa fa-user ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">ข้อมูลรายละเอียดช่าง</p>
                                        <p class="fw-bold mb-1">นายสาย ข้อยุ่น</p>
                                        <p class="text-muted mb-0">หัวหน้างานประปาเเละงานท่อ</p>
                                        <p class="text-muted mb-0">เบอร์ : 062386xxxx</p>
                                    </div>
                                </div>
                                <span class="badge rounded-pill badge-primary">Onboarding</span>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">
                            <a class="btn btn-link m-0 text-reset" href="#" role="button" data-ripple-color="primary"
                                data-mdb-ripple-init>ตารางงาน<i class="fa fa-comments ms-2"></i></a>
                            <a class="btn btn-link m-0 text-reset" href="#" role="button" data-ripple-color="primary"
                                data-mdb-ripple-init>เลือกช่าง<i class="fa fa-user ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">ข้อมูลรายละเอียดช่าง</p>
                                        <p class="fw-bold mb-1">นายสุรสิทธิ์ คำเอก</p>
                                        <p class="text-muted mb-0">หัวหน้างานระบบไฟฟ้า</p>
                                        <p class="text-muted mb-0">เบอร์ : 062386xxxx</p>
                                    </div>
                                </div>
                                <span class="badge rounded-pill badge-warning">Awaiting</span>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">
                            <a class="btn btn-link m-0 text-reset" href="#" role="button"
                                data-ripple-color="primary" data-mdb-ripple-init>ตารางงาน<i
                                    class="fa fa-comments ms-2"></i></a>
                            <a class="btn btn-link m-0 text-reset" href="#" role="button"
                                data-ripple-color="primary" data-mdb-ripple-init>เลือกช่าง<i
                                    class="fa fa-user ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/3.jpg" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="text-muted mb-0">ข้อมูลรายละเอียดช่าง</p>
                                        <p class="fw-bold mb-1">นายอุทัย สอนเพ็ง</p>
                                        <p class="text-muted mb-0">หัวหน้างานภูมิทัศน์ ทีม A เเละ ทีม B</p>
                                        <p class="text-muted mb-0">เบอร์ : 062386xxxx</p>
                                    </div>
                                </div>
                                <span class="badge rounded-pill badge-danger">Removed</span>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">
                            <a class="btn btn-link m-0 text-reset" href="#" role="button"
                                data-ripple-color="primary" data-mdb-ripple-init>ตารางงาน<i
                                    class="fa fa-comments ms-2"></i></a>
                            <a class="btn btn-link m-0 text-reset" href="#" role="button"
                                data-ripple-color="primary" data-mdb-ripple-init>เลือกช่าง<i
                                    class="fa fa-user ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@extends('layout.master')


@section('content')
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-xl-10 col-md-8 col-lg-9 ml-auto">
            <div class="row pt-md-7 mt-md-5 mb-5">

                <div class="col-xl-4 col-sm-6 p2 ">
                    <div class="card card-common mb-5">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-pie-chart fa-3x text-danger"></i>
                                <div class="text-end text-secondary">
                                    <h5>จำนวนเเจ้งซ่อม</h5>
                                    <h3>{{ $countRepair }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link"
                                href="{{ route('show.repair', ['p' => 10, 'status' => 'ทั้งหมด']) }}"></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 p2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-list-ol fa-3x text-primary"></i>
                                <div class="text-end text-secondary">
                                    <h5>ติดตามการแจ้งซ่อม</h5>
                                    <h3>*</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href="{{ route('repair.followUp') }}"></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 p2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-users fa-3x text-info"></i>
                                <div class="text-end text-secondary">
                                    <h5>จำนวนแอดมิน</h5>
                                    <h3>{{ $countAdmin }}</h3>
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

                <div class="col-xl-4 col-sm-6 p2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-users fa-3x text-success"></i>
                                <div class="text-end text-secondary">
                                    <h5>จำนวนนายช่าง</h5>
                                    <h3>{{ $countTechnician }}</h3>
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

                <div class="col-xl-4 col-sm-6 p2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-users fa-3x text-warning"></i>
                                <div class="text-end text-secondary">
                                    <h5>จำนวนแผนก</h5>
                                    <h3>{{ $department }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href="{{ route('D.index') }}"></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 p2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-door-closed fa-3x" style="color: C738BD"></i>
                                <div class="text-end text-secondary">
                                    <h5>ห้อง</h5>
                                    <h3>{{ $rooms }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href="{{ route('R.index') }}"></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

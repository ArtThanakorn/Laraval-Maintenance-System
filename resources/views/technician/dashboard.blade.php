@extends('layout.master')

@section('content')
    <!-- cards -->
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-xl-10 col-md-8 col-lg-9 ml-auto">
            <div class="row pt-md-7 mt-md-3 mb-5">

                <div class="col-xl-3 col-sm-6 p2">
                    <div class="card card-common mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-pie-chart fa-3x text-danger"></i>
                                <div class="text-right text-secondary">
                                    <h5>จำนวนเเจ้งซ่อม</h5>
                                    {{-- <h3>{{ $countRepair }}</h3> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link"
                                href="{{ route('technician.listwork', ['p' => 10]) }}"></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 p2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-users fa-3x text-info"></i>
                                <div class="text-right text-secondary">
                                    <h5>{{ 'ข้อมูลส่วนตัว' }}</h5>
                                    {{-- <h3>{{ $countAdmin }}</h3> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href="{{ route('technician.info') }}"></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->level === 1)
                    <div class="col-xl-3 col-sm-6 p2">
                        <div class="card card-common">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fa fa-users fa-3x text-success"></i>
                                    <div class="text-right text-secondary">
                                        <h5>{{ 'จำนวนนายช่าง' }}</h5>
                                        {{-- <h3>{{ $countTechnician }}</h3> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-secondary">
                                <a class="small text-white stretched-link" href="{{ route('T.Staff') }}"></a>
                                <i class="fa fa-arrow-circle-right mr-3"></i>
                                <span>ข้อมูลเพิ่มเติม</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

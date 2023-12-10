@extends('layout.master')

@section('content')
            <div class="card my-5 text-center">
                <div class="card-body">
                    <div class="row">
                        <i class="fa fa-check-circle fa-5x text-success text-center my-3"></i>
                        <h3>ยืนยันการเเจ่มซ่อมเรียบร้อย</h3>
                        <div class="d-grid gap-2 col-3 mx-auto my-2">
                            <a class="nav-link" href="{{ url('/admin/repair') }}">
                                <button class="btn btn-success"><i class="fa fa-home"></i>กลับหน้าหลัก</button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
@endsection

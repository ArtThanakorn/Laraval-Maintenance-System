@extends('layout.master')

@section('style')
    <style>
        ul.list-group.list-group-striped li:nth-of-type(odd) {
            background: #e9ecef;
        }

        ul.list-group.list-group-striped li:nth-of-type(even) {
            background: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="card my-5">
        <div class="card-body">
            <div class="row justify-content-center align-items-center g-2 mb-2">
                <div class="col-auto align-self-end" >
                    <i class="fa fa-check-circle fa-5x text-success  my-3"></i>
                </div>
                <div class="col-auto">
                    <h3>เเจ้งซ่อมสำเร็จ</h3>
                </div>
            </div>
            <div class="row justify-content-center align-items-center g-2 mb-2">
                <div class="col-8">
                    <div class="card">
                        <ul class="list-group list-group-hover list-group-striped">
                            <li class="list-group-item">
                                <div class="row g-2">
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ __('ชื่อ') }}</p>
                                    </div>
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ $dataconfirm->name }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row g-2">
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ __('รายละเอียด') }}</p>
                                    </div>
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ $dataconfirm->details }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row g-2">
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ __('สถานที่') }}</p>
                                    </div>
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ $dataconfirm->site }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row g-2">
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ __('Tag') }}</p>
                                    </div>
                                    <div class="col ">
                                        <p class="fs-5 mb-0">{{ $dataconfirm->tag_repair }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row row-cols-3 g-3">
                                    @foreach ($dataconfirm->imageRepair as $image)
                                        <div class="col">
                                            <figure class="row row-cols-4">

                                                <img src="{{ asset('uploads/repair/' . $image->nameImage) }}" alt="show"
                                                    style="width: 25rem">

                                            </figure>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="row justify-content-center align-items-center g-2 mb-2">
                <div class="col-auto">
                    <a class="btn btn-success" href="{{ route('index.repair') }}" role="button"><i
                            class="fa fa-home"></i>กลับหน้าหลัก</a>
                </div>
            </div>
        </div>
    </div>
@endsection

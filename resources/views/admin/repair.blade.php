@extends('layout.master')


@section('style')
    <link href="/css/repair_blade_admin.css" rel="stylesheet" />
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    {{-- <div class="row justify-content-center align-items-center g-1 mt-2"> --}}
    <form method="POST" action="{{ route('add.repair') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-list"></i>
                {{ 'ฟอร์มเเจ้งซ่อม' }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="fromCheck mb-2">
                        <label for="headfromcheck">{{"ตำแหน่งผู้แจ้ง"}}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusRadio" value="อาจารย์" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              {{"อาจารย์"}}
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusRadio" value="เจ้าหน้าที่" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                              {{"เจ้าหน้าที่"}}
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusRadio" value="นักศึกษา" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                              {{"นักศึกษา"}}
                            </label>
                          </div>
                    </div>
               
                    <div class="col-md-6">
                        <p>{{ 'ชื่อผู้เเจ้ง' }}</p>
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fas fa-user"></i>
                            </span>
                            <input class="form-control" type="text" name="chackname" placeholder="*ชื่อ-นายสกุล">
                        </div>
                        @error('chackname')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <p>แผนกส่งซ่อม
                                <b class="text-danger">*กรุณาคลิกเพื่ออ่านคำอธิบายในการเลือกเเผนก</b>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    คลิก
                                </button>
                            </p>


                            <div class="input-group">
                                <span class="input-group-text bg-info">
                                    <i class="fas fa-wrench"></i>
                                </span>
                                <select class="form-select" aria-label="Default select example" name="chacktype"
                                    id="chacktype">
                                    <option disabled selected>--เลือกประเภทงานซ่อม--</option>
                                    @foreach ($Department as $name)
                                        <option value="{{ $name->department_id }}">{{ $name->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">รายละเอียดปัญหา</label>
                            {{--  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="กรุณาระบุรายละเอียดปัญหา" name="detail"></textarea>  --}}
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fa fa-file-text"></i>
                            </span>
                            <input class="form-control" id="exampleFormControlTextarea1" rows="1"
                                placeholder="กรุณาระบุรายละเอียดปัญหา" name="detail">
                            {{--  <textarea class="form-control" id="exampleFormControlTextarea1" cols="30" rows="10" placeholder="กรุณาระบุรายละเอียดปัญหา" name="detail"></textarea>  --}}
                        </div>
                        @error('detail')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">สถานที่</label>
                                    {{--  <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                                            placeholder="*ระบุตึก ชั้น ห้อง สถานที่ให้ครบถ้วน" name="location"></textarea>  --}}
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-info">
                                        <i class="fa fa-location-arrow"></i>
                                    </span>
                                    <input class="form-control" id="exampleFormControlTextarea1" rows="1"
                                        placeholder="ระบุตึก ชั้น ห้อง สถานที่ให้ครบถ้วน" name="location">
                                </div>
                                @error('location')
                                    <span role="alert" class="text-danger">
                                        <strong> {{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ 'Email ผู้แจ้ง' }}</label>
                                    {{--  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">  --}}
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-info">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="name@example.com" name="email">
                                </div>
                                @error('email')
                                    <span role="alert" class="text-danger">
                                        <strong> {{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ 'เบอร์โทร' }}</label>
                                    {{--  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="082-8376xxx" name="number">  --}}
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-info">
                                        <i class="fas fa-phone-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="082-8376xxx" name="number">
                                </div>
                                @error('number')
                                    <span role="alert" class="text-danger">
                                        <strong> {{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formFileMultiple" class="form-label">{{ 'ภาพประกอบ' }}
                                <b class="text-danger">{{ '*เลือกรูปภาพได้ไม่เกิน 5 รูปภาพ' }}</b></label>
                            {{--  <input class="form-control" type="file" id="formFileMultiple" name="image[]" multiple>  --}}
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fa fa-file-image"></i>
                            </span>
                            <input class="form-control" type="file" id="formFileMultiple" name="image[]" multiple>
                        </div>
                        @error('image')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        @error('image.*')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>


            <div class="card-footer">
                <div class="row">
                    <div class="text-end">
                        <button type="submit" class="btn  btn-outline-success">{{"เเจ้งซ่อม"}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- </div> --}}


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">หมายเหตุ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><b>งานบริการทั่วไป</b> ดูเเลเกี่ยวกับ การให้ข้อมูล, การช่วยเหลือ,
                        หรือการแก้ไขปัญหาทั่วไป.
                    </p>
                    <p><b>งานประปาเเละงานท่อ</b> ดูเเลเกี่ยวกับ การออกแบบ, ติดตั้ง, และบำรุงรักษาระบบท่อ</p>
                    <p><b>งานระบบไฟฟ้า</b> ดูเเลเกี่ยวกับ การออกเเบบ, ติดตั้ง, การทดสอบ, และบำรุงรักษาระบบไฟฟ้า
                    </p>
                    <p><b>งานภูมิทัศน์</b> เน้นการออกแบบและการจัดการทิวทัศน์ทางธรรมชาติ เพื่อให้สวยงาม</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-primary">เข้าใจแล้ว</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
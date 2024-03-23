@extends('layout.master')

@section('content')
        <head>
            <link href="/css/repair_blade_admin.css" rel="stylesheet" />
        <head>
    <div class="container">
        {{--  <h1 class="mt-4">เเจ้งซ่อม</h1>  --}}

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <div class="row justify-content-center align-items-center g-0">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-list"></i>
                    ฟอร์มเเจ้งซ่อม
                </div>

                <form method="POST" action="{{ route('add.repair') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="container">
                            <p>ตำเเหน่งผู้เเจ้ง</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkstatus" id="blankCheckbox"
                                    value="อาจารย์">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    อาจารย์
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkstatus" id="blankCheckbox"
                                    value="เจ้าหน้าที่">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    เจ้าหน้าที่
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="checkstatus" id="blankCheckbox"
                                    value="นักศึกษา">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    นักศึกษา
                                </label>
                            </div>
                        </div>

                        @error('checkstatus')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <p>ชื่อผู้เเจ้ง</p>
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
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        คลิก
                                        </button>
                                    </p>


                                        <div class="input-group">
                                                <span class="input-group-text bg-info">
                                                    <i class="fas fa-wrench"></i>
                                                </span>
                                                <select class="form-select" aria-label="Default select example" name="chacktype" id="chacktype">
                                                    <option disabled selected>--เลือกประเภทงานซ่อม--</option>
                                                    @foreach ($Department as $name)
                                                        <option value="{{$name->department_id}}">{{$name->department_name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                </div>

                            </div>
                        </div>
                        <br>

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
                                    <input class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="กรุณาระบุรายละเอียดปัญหา" name="detail">
                                    {{--  <textarea class="form-control" id="exampleFormControlTextarea1" cols="30" rows="10" placeholder="กรุณาระบุรายละเอียดปัญหา" name="detail"></textarea>  --}}
                                </div>
                                @error('detail')
                                    <span role="alert" class="text-danger">
                                        <strong> {{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                            </div>
                        </div>

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
                                    <input class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="ระบุตึก ชั้น ห้อง สถานที่ให้ครบถ้วน" name="location">
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
                                        <label for="exampleFormControlInput1">Email ผู้แจ้ง</label>
                                        {{--  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">  --}}
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-info">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                                    {{--  <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-envelope"></i>
                                        </span>
                                    </div>  --}}

                                    {{--  <div class="form-group">
                                        <label for="exampleFormControlInput1">Email ผู้แจ้ง</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                                    </div>  --}}
                                    @error('email')
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">เบอร์โทร</label>
                                    {{--  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="082-8376xxx" name="number">  --}}
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-info">
                                        <i class="fas fa-phone-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="082-8376xxx" name="number">
                                    {{--  <div class="form-group">
                                        <label for="exampleFormControlInput1">เบอร์โทร</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="082-8376xxx" name="number">
                                    </div>  --}}
                                    @error('number')
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formFileMultiple" class="form-label">ภาพประกอบ <b class="text-danger">*เลือกรูปภาพได้ไม่เกิน 5 รูปภาพ</b></label>
                            {{--  <input class="form-control" type="file" id="formFileMultiple" name="image[]" multiple>  --}}
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fa fa-file-image"></i>
                            </span>
                            <input class="form-control" type="file" id="formFileMultiple" name="image[]" multiple>
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
                        <br>
                    </div>


                </form>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="text-end">
                        <button type="submit" class="btn  btn-outline-success">เเจ้งซ่อม</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="staticBackdropLabel">หมายเหตุ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p><b>งานบริการทั่วไป</b> ดูเเลเกี่ยวกับ การให้ข้อมูล, การช่วยเหลือ, หรือการแก้ไขปัญหาทั่วไป.</p>
            <p><b>งานประปาเเละงานท่อ</b> ดูเเลเกี่ยวกับ การออกแบบ, ติดตั้ง, และบำรุงรักษาระบบท่อ</p>
            <p><b>งานระบบไฟฟ้า</b> ดูเเลเกี่ยวกับ การออกเเบบ, ติดตั้ง, การทดสอบ, และบำรุงรักษาระบบไฟฟ้า</p>
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
    <script>
        /*
        // รับค่าของ <select>
        const selectElement = document.getElementById("chacktype");
        const otherField = document.getElementById("otherField");
        const otherTypeInput = document.getElementById("otherType");

        // เพิ่มกฎเกณฑ์การแสดงฟิลด์ <input> เมื่อเลือก "อื่นๆ"
        selectElement.addEventListener("change", function() {
            if (selectElement.value === "อื่นๆ") {
                otherField.style.display = "block"; // แสดงฟิลด์
            } else {
                otherField.style.display = "none"; // ซ่อนฟิลด์
                otherTypeInput.value = ""; // ล้างค่าของฟิลด์ <input>
            }
        });

        Swal.fire({
            title: 'Error!',
            text: 'Do you want to continue',
            icon: 'error',
            confirmButtonText: 'Cool'
        })
        */
    </script>
@endsection

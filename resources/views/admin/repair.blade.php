@extends('layout.master')

@section('content')
    <div class="container">
        <h1 class="mt-4">เเจ้งซ่อม</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif


        <div class="row justify-content-center align-items-center g-2">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-list"></i>
                    ฟอร์มเเจ้งซ่อม
                </div>

                <form method="POST" action="{{ route('add.repair') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <p>ผู้เเจ้ง</p>
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

                        @error('checkstatus')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <p>ชื่อผู้เเจ้ง</p>
                        <input class="form-control" type="text" name="chackname" placeholder="*ชื่อ-นายสกุล">
                        @error('chackname')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <p>ประเภทงานซ่อม</p>
                        <select class="form-select" aria-label="Default select example" name="chacktype" id="chacktype">
                            <option disabled selected>--เลือกประเภทงานซ่อม--</option>
                            @foreach ($Department as $name)
                                <option value="{{$name->department_id}}">{{$name->department_name}}</option>
                            @endforeach
                        </select>

                        <!-- ฟิลด์ input เมื่อเลือก "อื่นๆ" -->
                        {{-- <div id="otherField" style="display: none;"> 
                            <br>
                            <label for="otherType">กรุณาระบุประเภทงาน :</label>
                            <input class="form-control" type="text" name="otherType" id="otherType">
                        </div>--}}

                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">รายละเอียดปัญหา</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="*ต้องการข้อมูล"
                                name="detail"></textarea>
                        </div>
                        @error('detail')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">สถานที่</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                placeholder="*ระบุตึก ชั้น ห้อง สถานที่ให้ครบถ้วน" name="location"></textarea>
                        </div>
                        @error('location')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email ผู้เเจ้ง</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com" name="email">
                        </div>
                        @error('email')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">เบอร์โทร</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="082-8376xxx" name="number">
                        </div>
                        @error('number')
                            <span role="alert" class="text-danger">
                                <strong> {{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <div class="form-group">
                            <label for="formFileMultiple" class="form-label">ภาพประกอบ (บังคับเลือกได้ไม่เกิน 5
                                รูปภาพ)</label>
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
                        <br>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="text-end">
                                {{--  <a href="#" class="btn btn-primary">เเจ้งซ่อม</a>  --}}
                                <button type="submit" class="btn btn-primary">เเจ้งซ่อม</button>
                            </div>
                        </div>
                    </div>

                </form>
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

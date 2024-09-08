@extends('layout.master')

@section('style')
    <style>
        .container-fluid {
            margin-top: 10rem !important;
          }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h3>{{ 'แก้ไขข้อมูลส่วนตัว' }}</h3>
            <form id="form-edit-technician" class="row g-3" action="{{ route('T.edit.info') }}" method="post">
                {{--  --}}
                @csrf
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">{{ 'Email' }}</label>
                    <input type="Email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email', $Uinfo->email) }}" placeholder="Email@gmail.com">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">{{ 'Password' }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        value="{{ old('password', $Uinfo->password) }}" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">{{ 'ชื่อ - นามสกุล' }}</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                        value="{{ old('username', $Uinfo->name) }}" placeholder="ชื่อ-นามสกุล">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="iduser" value="{{ $Uinfo->id }}">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">{{ 'แผนก' }}</label>
                    <input type="text" class="form-control " id="inputEmail4" value="{{ $Uinfo->department_name }}"
                        placeholder="แผนก" disabled readonly>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">{{ 'ระดับ' }}</label>
                    <input type="text" class="form-control " id="inputPassword4"
                        value="{{ $Uinfo->level = 1 ? 'หัวหน้า' : 'พนักงาน' }}" placeholder="ระดับ" disabled readonly>
                </div>

                <div class="row justify-content-end align-items-center g-2">
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-success">{{ 'บันทึกการแก้ไขข้อมูลส่วนตัว' }}</button>
                    </div>
                    <div class="col-md-auto">
                        <a class="btn btn-danger" href="{{route('technician.dashboard')}}" role="button">{{ 'ยกเลิก' }}</a>
                        {{-- <button type="button" class="btn btn-danger">{{ 'ยกเลิก' }}</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        const formedittechnician = document.getElementById('form-edit-technician');
        formedittechnician.addEventListener("submit", (e) => {
            // e.preventDefault();
            console.log('123');

            let isError = {
                editName: false,
                editEmail: false,
                editPassword: false,
            };
            let isValid = true;

            // Get form data
            let formData = new FormData(formedittechnician);
            const Name = formData.get('username');
            const Email = formData.get('email');
            const Password = formData.get('password');

            if (Name.trim().length < 1) {
                isError.aName = true;
                // document.getElementById('error-add-name').innerHTML = "กรุณาระบุชื่อ - นามสกุล";
            } else {
                isError.aName = false;
                // document.getElementById('error-add-name').innerHTML = "";
            }

            if (Email.trim().length < 1) {
                isError.aEmail = true;
                // document.getElementById('error-add-email').innerHTML = "กรุณาระบุอีเมล";
            } else if (!/^[\w-.]+@[\w-.]+\.[a-zA-Z]{2,}$/.test(Email)) {
                isError.aEmail = true;
                // document.getElementById('error-add-email').innerHTML = "รูปแบบอีเมลไม่ถูกต้อง";
            } else {
                isError.aEmail = false;
                //document.getElementById('error-add-email').innerHTML = "";
            }

            if (Password.trim().length < 1) {
                isError.aPassword = true;
                //document.getElementById('error-add-password').innerHTML = "กรุณาระบุรหัสผ่าน";
            } else if (Password.trim().length <= 8) {
                isError.aPassword = true;
                //document.getElementById('error-add-password').innerHTML = "รหัสผ่านต้องมากกว่า 8";
            } else {
                isError.aPassword = false;
                //document.getElementById('error-add-password').innerHTML = "";
            }

            const hasError = Object.values(isError).find((err) => err === true);
            hasError ? isValid = false : isValid = true;

            if (isValid) {
                /* Display the key/value pairs*/
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                // return false;
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "แก้ไขข้อมูลส่วนตัวเสร็จสิ้น",
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    location.reload();
                });
            }
        });
    </script>
@endsection

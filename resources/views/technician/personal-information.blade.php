@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>{{ 'แก้ไขข้อมูลส่วนตัว' }}</h3>
            <form class="row g-3" action="{{ route('T.edit.info') }}" method="post">
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">{{ 'Email' }}</label>
                    <input type="Email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $Uinfo->email }}" placeholder="Email@gmail.com">
                    @error('email')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">{{ 'Password' }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        value="{{ $Uinfo->password }}" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">{{ 'ชื่อ - นามสกุล' }}</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" value="username"
                        value="{{ $Uinfo->name }}" placeholder="ชื่อ-นามสกุล">
                    @error('username')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    @enderror
                </div>
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
                        <button type="button" class="btn btn-danger">{{ 'ยกเลิก' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layout.master')

@section('content')
    <div class="row justify-content-center my-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">เพิ่มผู้ใช้งานช่าง1</div>
                <form action="#" method="post">
                    @csrf
                    <div class="row mb-3 mt-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ชื่อ-นามสกุล') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('รหัสผ่าน') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-end">{{ __('ยืนยันรหัสผ่าน') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('บันทึก') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-2 col-md-4 col-lg-8">
            <div class="card">
                <div class="card-header">
                    {{ __('ผู้ดูแลระบบ') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tbTu">
                            <tbody>
                                @foreach ($liTechnicianUser as $dataTu)
                                    <tr class="">
                                        <td scope="row">{{ $dataTu->name }}</td>
                                        <td>{{ $dataTu->email }}</td>
                                        <td>
                                            <a name="" id="" class="btn btn-warning"
                                                href="{{ route('edit.AuId', ['au_id' => $dataTu->id]) }}"
                                                role="button">แก้ไข</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-item"
                                                data-admin_id="{{ $dataTu->id }}">ลบ</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endsection

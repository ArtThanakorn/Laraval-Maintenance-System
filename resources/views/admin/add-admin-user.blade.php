@extends('layout.master')

@section('content')
    <div class="row justify-content-center my-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (empty($DataAu->id))
                        {{ __('เพิ่มผู้ใช้งานผู้ดูแลระบบ') }}
                    @else
                        {{ __('แก้ไขผู้ใช้งานผู้ดูแลระบบ') }}
                    @endif
                </div>
                {{-- <div class="card-body">
                    <form action="{{ empty($DataAu->id) ? route('store.account.admin') : route('update.Au', ['au_id' => $DataAu->id]) }}" method="post">
                        @if (!empty($DataAu->id))
                            @method('put')
                        @endif
                        @csrf
                        <div class="row mb-3 mt-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ชื่อ-นามสกุล') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', $DataAu->name) }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email', $DataAu->email) }}" required autocomplete="email">

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
                            <label for="confirmpassword"
                                class="col-md-4 col-form-label text-md-end">{{ __('ยืนยันรหัสผ่าน') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
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
                </div> --}}


                <div class="card-body">
                    <form id="addUser" data-parsley-validate>
                        <div class="form-group my-2">
                            <input id="name" class="form-control" type="text" name="name" placeholder="ชื่อ - นามสกุล" required data-parsley-trigger="change" data-parsley-required-message="กรุณากรอกชื่อ-นามสกุล">
                        </div>
                        <div class="form-group my-2">
                            <input id="email" class="form-control" type="text" name="email" placeholder="อีเมล" required  data-parsley-trigger="change" data-parsley-required-message="กรุณากรอกอีเมล"
                            data-parsley-type-message="รูปแบบอีเมลไม่ถูกต้อง">
                        </div>
                        <div class="form-group my-2">
                            <input id="password" class="form-control" type="password" name="password" placeholder="รหัสผ่าน" required  data-parsley-required-message="กรุณากรอกรหัสผ่าน">
                        </div>
                        <div class="form-group my-2">
                            <input id="password-confirm" class="form-control" type="password" name="password" placeholder="ยืนยันรหัสผ่าน"
                                required data-parsley-equalto="#password" data-parsley-equalto-message="รหัสผ่านไม่ตรง">
                        </div>
                        <button class="btn btn-primary form-control" type="button" onclick="submitForm()">บันทึก</button>
                    </form>

                    {{-- <form id="myForm" data-parsley-validate>
                        <div class="row mb-3 mt-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ชื่อ-นามสกุล') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name', $DataAu->name) }}" required autocomplete="name" autofocus
                                    data-parsley-trigger="change" data-parsley-required-message="กรุณากรอกชื่อ-นามสกุล">
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
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email', $DataAu->email) }}" required autocomplete="email"
                                    data-parsley-trigger="change" data-parsley-required-message="กรุณากรอกอีเมล"
                                    data-parsley-type-message="รูปแบบอีเมลไม่ถูกต้อง">

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
                                    autocomplete="new-password" data-parsley-required-message="กรุณากรอกรหัสผ่าน">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="confirmpassword"
                                class="col-md-4 col-form-label text-md-end">{{ __('ยืนยันรหัสผ่าน') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" data-parsley-equalto="#password" data-parsley-equalto-message="รหัสผ่านไม่ตรง"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" onclick="submitForm()">
                                    {{ __('บันทึก') }}
                                </button>
                            </div>
                        </div>
                    </form> --}}
                </div>
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
                        <table class="table table-striped" id="tbAu">
                            <tbody>
                                @foreach ($liAdminUser as $data)
                                    <tr class="">
                                        <td scope="row">{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            <a name="" id="" class="btn btn-warning"
                                                href="{{ route('edit.AuId', ['au_id' => $data->id]) }}"
                                                role="button">แก้ไข</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-item"
                                                data-admin_id="{{ $data->id }}">ลบ</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function submitForm() {
            if ($('#addUser').parsley().validate()) { //#myForm
                // Get form data
                var formData = new FormData(document.getElementById('addUser'));

                for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
                
                // Determine the URL for the Axios request
                var url =
                    "{{ empty($DataAu->id) ? route('store.account.admin') : route('update.Au', ['au_id' => $DataAu->id]) }}";

                // Determine the HTTP method (POST or PUT)
                var method = "{{ !empty($DataAu->id) ? 'put' : 'post' }}";

                // Send the Axios request

            }
        }

        document.querySelector('#tbAu').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.admin_id);
                Swal.fire({
                    title: 'คุณต้องการลบผู้ใช้งานนี้หรือไม่',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ต้องการ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("{{ route('destroy.admin', ['au_id' => $data->id]) }}")
                            .then((response) => {
                                Swal.fire(
                                    'ลบแล้ว!',
                                    'ข้อมูลของคุณถูกลบไปแล้ว',
                                    'success'
                                );
                                setTimeout(() => {
                                    window.location.href = "{{ route('pages.addadmin') }}";
                                }, 2000);
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ผิดพลาด',
                                    text: 'ไม่สามารถลบผู้ใช้นี้ได้',
                                    // footer: '<a href="">Why do I have this issue?</a>'
                                })
                            });
                    }
                });
            }
        });
    </script>
@endsection

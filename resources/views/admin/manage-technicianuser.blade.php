@extends('layout.master')

@section('content')
        <head>
            <link href="/css/add-admin-user.css" rel="stylesheet" />
        <head>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 p-2">
                        <h3>
                            @if (empty($DataTu->id))
                            {{ __('เพิ่มผู้ใช้งานช่าง') }}
                            @else
                            {{ __('แก้ไขผู้ใช้งานช่าง') }}
                            @endif
                        </h3>
                        <form id="addTechnician" data-parsley-validate>
                            <div class="form-group my-2">
                                <input value="{{ old('name', $DataTu->name) }}" id="name" @error('name') is-invalid @enderror class="form-control" type="text" name="name" placeholder="ชื่อ - นามสกุล" required data-parsley-trigger="change" data-parsley-required-message="กรุณากรอกชื่อ-นามสกุล">
                            </div>
                            <div class="form-group my-2">
                                <input value="{{ old('email', $DataTu->email) }}" id="email" class="form-control" type="text" name="email" placeholder="อีเมล" required  data-parsley-trigger="change" data-parsley-required-message="กรุณากรอกอีเมล"data-parsley-type-message="รูปแบบอีเมลไม่ถูกต้อง">
                            </div>
                            <div class="form-group my-2">
                                <input id="password" class="form-control" type="password" name="password" placeholder="รหัสผ่าน" required  data-parsley-required-message="กรุณากรอกรหัสผ่าน">
                            </div>
                            <div class="form-group my-2">
                                <input id="password-confirm" class="form-control" type="password" name="password" placeholder="ยืนยันรหัสผ่าน" required data-parsley-equalto="#password"  data-parsley-required-message="กรุณากรอกรหัสผ่าน" data-parsley-equalto-message="รหัสผ่านไม่ตรง">
                            </div>
                            <button class="btn btn-primary form-control" type="button" onclick="submitForm()">บันทึก</button>
                        </form>
                    </div>
                    <div class="col-md-8 p-2">
                        <h3>รายชื่อสมาชิก</h3>
                        <table id="UtTable" class="table table-striped">
                            <tr>
                                <th colspan="col"> ลำดับ </th>
                                <th colspan="col">ชื่อ</th>
                                <th colspan="col">อีเมล</th>
                                <th colspan="col"></th>
                            </tr>

                                            @foreach ($liTechnicianUser as $key => $data)
                                            @dd($data)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>
                                                    <a name="" id="" class="btn btn-success"
                                                            href="{{ route('edit.TuId', ['tu_id' => $data->id]) }}"
                                                            role="button" >แก้ไข</a>
                                                    <button type="button" class="btn btn-danger delete-item" data-technician_id="{{ $data->id }}" >ลบ</button>
                                                </td>
                                            </tr>
                                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
    @endsection

    @section('script')
    <script>
        function submitForm() {
            if ($('#addTechnician').parsley().validate()) {
                // Get form data
                let formData = new FormData(document.getElementById('addTechnician'));

                // Determine the URL for the Axios request
                let url =
                    "{{ empty($DataTu->id) ? route('store.account.technician') : route('update.Tu', ['tu_id' => $DataTu->id]) }}";

                // Send the Axios request
                 axios.post(url,formData)
                    .then(function(response) {
                        // Handle the success response if needed
                        console.log(response.data);
                        Swal.fire({
                            title: response.data.message,
                            width: 600,
                            padding: "3em",
                            color: "#716add",
                            background: "#fff url(/images/trees.png)",
                            backdrop: `
                                        rgba(0,0,123,0.4)
                                        url("/images/nyan-cat.gif")
                                        left top
                                        no-repeat
                                      `
                        });
                        window.location.href = "{{ route('technician.index') }}";
                    })
                    .catch(function(error) {
                        // Handle the error response if needed
                        console.error(error);
                    });
            }
        }

        document.querySelector('#UtTable').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.technician_id);
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



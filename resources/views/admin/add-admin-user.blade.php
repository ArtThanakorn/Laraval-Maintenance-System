@extends('layout.master')

@section('style')
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .parsley-required,
        .parsley-equalto {
            color: red;
            padding-top: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center g-2">
                <div class="col-3">ผู้ใช้งานผู้ดูแลระบบ</div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                        <i class="bi bi-plus-square"></i> เพิ่มผู้ใช้งานผู้ดูแลระบบ
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="AuTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="col"> ลำดับ </th>
                            <th colspan="col">ชื่อ</th>
                            <th colspan="col">อีเมล</th>
                            <th colspan="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liAdminUser as $key => $dataAu)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $dataAu->name }}</td>
                                <td>{{ $dataAu->email }}</td>
                                <td>
                                    <div class="row justify-content-start align-items-center g-2">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary"
                                                onclick="resetAu({{ $dataAu->id }})" data-bs-toggle="modal"
                                                data-bs-target="#ModalReset">
                                                รีเซ็ตรหัสผ่าน
                                            </button>

                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="editAu({{ $dataAu->id }})"
                                                class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit">
                                                แก้ไข
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger delete-item"
                                                data-admin_id="{{ $dataAu->id }}">ลบ</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal-add -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="ModalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addUser" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalAddLabel">เพิ่มผู้ใช้งานผู้ดูแลระบบ</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input id="name" @error('name') is-invalid @enderror class="form-control" type="text"
                                name="name" placeholder="ชื่อ - นามสกุล" required="" data-parsley-trigger="change"
                                data-parsley-required-message="กรุณากรอกชื่อ-นามสกุล">
                        </div>
                        <div class="form-group my-2">
                            <input id="email" class="form-control" type="text" name="email" placeholder="อีเมล"
                                required="" data-parsley-trigger="change"
                                data-parsley-required-message="กรุณากรอกอีเมล"data-parsley-type-message="รูปแบบอีเมลไม่ถูกต้อง">
                        </div>

                        <div class="form-group my-2">
                            <input id="password" class="form-control" type="password" name="password"
                                placeholder="รหัสผ่าน" required data-parsley-required-message="กรุณากรอกรหัสผ่าน">
                        </div>
                        <div class="form-group my-2">
                            <input id="password-confirm" class="form-control" type="password" name="password_confirmation"
                                placeholder="ยืนยันรหัสผ่าน" required data-parsley-equalto="#password"
                                data-parsley-required-message="กรุณากรอกรหัสผ่าน"
                                data-parsley-equalto-message="รหัสผ่านไม่ตรง">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="submitForm()" class="btn btn-primary">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal-edit -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return updateAu(event)" id="editUser" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalEditLabel">แก้ไขผู้ใช้งานผู้ดูแลระบบ</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group my-2">
                            <input id="nameEdit" class="form-control" type="text" name="name"
                                placeholder="ชื่อ - นามสกุล" required="" data-parsley-trigger="change"
                                data-parsley-required-message="กรุณากรอกชื่อ-นามสกุล">
                        </div>
                        <div class="form-group my-2">
                            <input id="emailEdit" class="form-control" type="text" name="email"
                                placeholder="อีเมล" required="" data-parsley-trigger="change"
                                data-parsley-required-message="กรุณากรอกอีเมล"data-parsley-type-message="รูปแบบอีเมลไม่ถูกต้อง">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit-editUser" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal-reset -->
    <div class="modal fade" id="ModalReset" tabindex="-1" aria-labelledby="ModalResetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="resetUserAdmin" data-parsley-validate onsubmit="return submitFormResetPassword(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalResetLabel">รีเซ็ตรหัสผ่าน</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="resetId">
                        <div class="form-group my-2">
                            <input id="reset-password" class="form-control" type="password" name="password_reset"
                                placeholder="รหัสผ่าน" required data-parsley-required-message="กรุณากรอกรหัสผ่าน">
                        </div>
                        <div class="form-group my-2">
                            <input id="reset-password-confirm" class="form-control" type="password"
                                name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" required
                                data-parsley-equalto="#reset-password" data-parsley-required-message="กรุณากรอกรหัสผ่าน"
                                data-parsley-equalto-message="รหัสผ่านไม่ตรง">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit-resetUserPassword"  class="btn btn-primary reset-item">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function submitForm() {
            if ($('#addUser').parsley().validate()) {
                // Get form data
                let formData = new FormData(document.getElementById('addUser'));

                // Determine the URL for the Axios request
                let url = "{{ route('store.userAdmin') }}";

                // Send the Axios request
                axios.post(url, formData)
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
                        }).then((result) => {
                            location.reload();
                        });
                    })
                    .catch(function(error) {
                        // Handle the error response if needed
                        console.error(error);
                    });
            }
        }

        function editAu(id) {
            let editId = document.getElementById("editId");
            let name = document.getElementById("nameEdit");
            let email = document.getElementById("emailEdit");
            if (id) {
                axios.get($url + `/admin/edit/${id}`)
                    .then(function(response) {
                        data = response.data;
                        console.log(data);
                        // let formData = new FormData(document.getElementById('editUser'));
                        editId.value = data.Technician.id
                        name.value = data.Technician.name
                        email.value = data.Technician.email
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }

        function updateAu(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            const id = formData.get('id');

            axios.post($url + `/admin/user/update/${id}`, formData)
                .then(res => {
                    console.log(res)
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: res.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((res) => {
                        location.reload();
                    });
                })
                .catch(function(error) {
                    // Handle the error response if needed
                    console.error(error);
                });
        }

        function resetAu(id) {
            console.log(id);
            document.getElementById("resetId").value = id;
            document.getElementById("reset-password").value = "";
            document.getElementById("reset-password-confirm").value ="";
        }

        function submitFormResetPassword(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const id = formData.get('id');
            /* Display the key/value pairs*/
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
            if ($('#resetUserAdmin').parsley().validate()) {
                axios.post($url + `/admin/user/reset/password/${id}`, formData)
                .then(res => {
                    console.log(res)
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: res.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((res) => {
                        location.reload();
                    });
                })
                .catch(function(error) {
                    // Handle the error response if needed
                    console.error(error);
                });
            }
        }

        document.querySelector('#AuTable').addEventListener('click', (e) => {
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
                        axios.delete($url + `/admin/user/destroy/` + e.target.dataset.admin_id)
                            .then((response) => {
                                Swal.fire(
                                    'ลบแล้ว!',
                                    'ข้อมูลของคุณถูกลบไปแล้ว',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
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

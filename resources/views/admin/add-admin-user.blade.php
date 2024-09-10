@extends('layout.master')

@section('style')
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
        .container-fluid {
            margin-top: 10rem !important;
          }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center g-2">
                <div class="col-3">{{ 'ผู้ใช้งานผู้ดูแลระบบ' }}</div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="addForm()" data-bs-toggle="modal"
                        data-bs-target="#ModalAdd">
                        <i class="bi bi-plus-square"></i> {{ 'เพิ่มผู้ใช้งานผู้ดูแลระบบ' }}
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="AuTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="col"> {{ 'ลำดับ' }} </th>
                            <th colspan="col">{{ 'ชื่อ' }}</th>
                            <th colspan="col">{{ 'อีเมล' }}</th>
                            <th colspan="col">{{ 'จัดการ' }}</th>
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
                                                {{ 'รีเซ็ตรหัสผ่าน' }}
                                            </button>

                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="editAu({{ $dataAu }})"
                                                class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit">
                                                {{ 'แก้ไข' }}
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger delete-item"
                                                data-admin_id="{{ $dataAu->id }}">{{ 'ลบ' }}</button>
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
            <form id="addUser">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalAddLabel">{{ 'เพิ่มผู้ใช้งานผู้ดูแลระบบ' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input id="name" class="form-control" type="text" name="name"
                                placeholder="ชื่อ - นามสกุล">
                            <div id="error-add-name" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="email" class="form-control" type="text" name="email" placeholder="อีเมล">
                            <div id="error-add-email" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>

                        <div class="form-group my-2">
                            <input id="password" class="form-control" type="password" name="password"
                                placeholder="รหัสผ่าน">
                            <div id="error-add-password" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="password-confirm" class="form-control" type="password" name="password_confirmation"
                                placeholder="ยืนยันรหัสผ่าน">
                            <div id="error-add-confirm-password" class="form-text text-danger" style="margin-left: 1rem">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ 'บันทึก' }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ 'ยกเลิก' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal-edit -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editUser">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalEditLabel">{{ 'แก้ไขผู้ใช้งานผู้ดูแลระบบ' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input id="nameEdit" class="form-control" type="text" name="nameEdit"
                                placeholder="ชื่อ - นามสกุล">
                            <div id="error-edit-name" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="emailEdit" class="form-control" type="text" name="emailEdit"
                                placeholder="อีเมล">
                            <div id="error-edit-email" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ 'บันทึก' }}</button>
                        <button type="button" class="btn btn-danger" id="closemodal"
                            data-bs-dismiss="modal">{{ 'ยกเลิก' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal-reset -->
    <div class="modal fade" id="ModalReset" tabindex="-1" aria-labelledby="ModalResetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="resetUserAdmin">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalResetLabel">{{ 'รีเซ็ตรหัสผ่าน' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input id="reset-password" class="form-control" type="password" name="password_reset"
                                placeholder="รหัสผ่าน">
                            <div id="error-reset-password" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="reset-password-confirm" class="form-control" type="password"
                                name="password_confirmation" placeholder="ยืนยันรหัสผ่าน">
                            <div id="error-reset-confirm-password" class="form-text text-danger"
                                style="margin-left: 1rem"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit-resetUserPassword"
                            class="btn btn-primary reset-item">{{ 'บันทึก' }}</button>
                        <button type="button" class="btn btn-secondary" id="closereset"
                            data-bs-dismiss="modal">{{ 'ยกเลิก' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function addForm() {
            document.getElementById('name').value = "";
            document.getElementById('error-add-name').innerHTML = "";
            document.getElementById('email').value = "";
            document.getElementById('error-add-email').innerHTML = "";
            document.getElementById('password').value = "";
            document.getElementById('error-add-password').innerHTML = "";
            document.getElementById('password-confirm').value = "";
            document.getElementById('error-add-confirm-password').innerHTML = "";

            const formaddtUa = document.querySelector('#addUser');
            // Determine the URL for the Axios request
            let url = "{{ route('store.userAdmin') }}";

            let isError = {
                aName: false,
                aEmail: false,
                aPassword: false,
                aConPassword: false,
            };
            let isValid = true;

            formaddtUa.addEventListener("submit", (e) => {
                e.preventDefault();

                // Get form data
                let formData = new FormData(formaddtUa);
                const Name = formData.get('name');
                const Email = formData.get('email');
                const Password = formData.get('password');
                const ConPassword = formData.get('password_confirmation');

                if (Name.trim().length < 1) {
                    isError.aName = true;
                    document.getElementById('error-add-name').innerHTML = "กรุณาระบุชื่อ - นามสกุล";
                } else {
                    isError.aName = false;
                    document.getElementById('error-add-name').innerHTML = "";
                }

                if (Email.trim().length < 1) {
                    isError.aEmail = true;
                    document.getElementById('error-add-email').innerHTML = "กรุณาระบุอีเมล";
                } else if (!/^[\w-.]+@[\w-.]+\.[a-zA-Z]{2,}$/.test(Email)) {
                    isError.aEmail = true;
                    document.getElementById('error-add-email').innerHTML = "รูปแบบอีเมลไม่ถูกต้อง";
                } else {
                    isError.aEmail = false;
                    document.getElementById('error-add-email').innerHTML = "";
                }

                if (Password.trim().length < 1) {
                    isError.aPassword = true;
                    document.getElementById('error-add-password').innerHTML = "กรุณาระบุรหัสผ่าน";
                } else if (Password.trim().length <= 8) {
                    isError.aPassword = true;
                    document.getElementById('error-add-password').innerHTML = "รหัสผ่านต้องมากกว่า 8";
                } else {
                    isError.aPassword = false;
                    document.getElementById('error-add-password').innerHTML = "";
                }

                if (ConPassword.trim().length < 1) {
                    isError.aConPassword = true;
                    document.getElementById('error-add-confirm-password').innerHTML = "กรุณายืนยันรหัสผ่าน";
                } else if (ConPassword != Password) {
                    isError.aConPassword = true;
                    document.getElementById('error-add-confirm-password').innerHTML = "รหัสผ่านไม่ตรง";
                } else {
                    isError.aConPassword = false;
                    document.getElementById('error-add-confirm-password').innerHTML = "";
                }

                const hasError = Object.values(isError).find((err) => err === true);
                hasError ? isValid = false : isValid = true;

                if (isValid) {

                    axios.post(url, formData)
                        .then(function(response) {
                            // Handle the success response if needed
                            console.log(response.data);
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: response.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                location.reload();
                            });
                        })
                        .catch(function(error) {
                            // Handle the error response if needed
                            console.error(error);
                        });
                }
            })
        }

        function editAu(row) {
            console.log(row);
            // return false;
            let name = document.getElementById("nameEdit");
            let email = document.getElementById("emailEdit");
            document.getElementById('error-edit-name').innerHTML = "";
            document.getElementById('error-edit-email').innerHTML = "";

            name.value = row.name
            email.value = row.email

            const formeditUa = document.querySelector('#editUser');
            let isError = {
                eName: false,
                eEmail: false,
            };
            let isValid = true;


            formeditUa.onsubmit = function(e) {
                e.preventDefault();

                // Get form data
                let formData = new FormData(formeditUa);
                const Name = formData.get('nameEdit');
                const Email = formData.get('emailEdit');

                if (Name.trim().length < 1) {
                    isError.eName = true;
                    document.getElementById('error-edit-name').innerHTML = "กรุณาระบุชื่อ - นามสกุล";
                } else {
                    isError.eName = false;
                    document.getElementById('error-edit-name').innerHTML = "";
                }

                if (Email.trim().length < 1) {
                    isError.eEmail = true;
                    document.getElementById('error-edit-email').innerHTML = "กรุณาระบุอีเมล";
                } else if (!/^[\w-.]+@[\w-.]+\.[a-zA-Z]{2,}$/.test(Email)) {
                    isError.eEmail = true;
                    document.getElementById('error-edit-email').innerHTML = "รูปแบบอีเมล";
                } else {
                    isError.eEmail = false;
                    document.getElementById('error-edit-email').innerHTML = "";
                }

                const hasError = Object.values(isError).find((err) => err === true);
                hasError ? isValid = false : isValid = true;



                if (isValid) {

                    axios.post($url + `/admin/user/update/${row.id}`, formData)
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
        }

        function resetAu(id) {
            console.log(id);
            document.getElementById("reset-password").value = "";
            document.getElementById('error-reset-password').innerHTML = "";
            document.getElementById("reset-password-confirm").value = "";
            document.getElementById('error-reset-confirm-password').innerHTML = "";

            const formresetUa = document.querySelector('#resetUserAdmin');

            let isError = {
                rpassword: false,
                rpasswordConfirm: false,
            };

            let isValid = true;

            // const submitButton = document.getElementById('submit-resetUserPassword');
            formresetUa.removeEventListener('click', resetAu); // Ensure you use a named function

            formresetUa.onsubmit = function(e) {
                e.preventDefault();

                // Get form data
                let formData = new FormData(formresetUa);
                const Password = formData.get('password_reset');
                const ConPassword = formData.get('password_confirmation');

                if (Password.trim().length < 1) {
                    isError.rpassword = true;
                    document.getElementById('error-reset-password').innerHTML = "กรุณาระบุรหัสผ่าน";
                } else if (Password.trim().length <= 8) {
                    isError.rpassword = true;
                    document.getElementById('error-reset-password').innerHTML = "รหัสผ่านต้องมากกว่า 8";
                } else {
                    isError.rpassword = false;
                    document.getElementById('error-reset-password').innerHTML = "";
                }

                if (ConPassword.trim().length < 1) {
                    isError.rpasswordConfirm = true;
                    document.getElementById('error-reset-confirm-password').innerHTML = "กรุณายืนยันรหัสผ่าน";
                } else if (ConPassword != Password) {
                    isError.rpasswordConfirm = true;
                    document.getElementById('error-reset-confirm-password').innerHTML = "รหัสผ่านไม่ตรง";
                } else {
                    isError.rpasswordConfirm = false;
                    document.getElementById('error-reset-confirm-password').innerHTML = "";
                }

                const hasError = Object.values(isError).find((err) => err === true);
                hasError ? isValid = false : isValid = true;

                if (isValid) {
                    axios.post($url + `/admin/user/reset/password/${id}`, formData)
                        .then(res => {
                            console.log(res);
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

            };

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

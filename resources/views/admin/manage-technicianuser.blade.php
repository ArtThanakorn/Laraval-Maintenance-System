@extends('layout.master')

@section('style')
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center g-2">
                <div class="col-3">{{ 'ผู้ใช้งานช่าง' }}</div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="submitForm()" data-bs-toggle="modal"
                        data-bs-target="#ModalAdd">
                        <i class="bi bi-plus-square"></i> {{ 'เพิ่มผู้ใช้งานช่าง' }}
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="UtTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="col"> {{ 'ลำดับ' }} </th>
                            <th colspan="col">{{ 'ชื่อ' }}</th>
                            <th colspan="col">{{ 'แผนก' }}</th>
                            <th colspan="col">{{ 'อีเมล' }}</th>
                            <th colspan="col">{{ 'จัดการ' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liTechnicianUser as $key => $dataUt)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $dataUt->name }}</td>
                                <td>{{ $dataUt->departments->department_name }}</td>
                                <td>{{ $dataUt->email }}</td>
                                <td>
                                    <div class="row justify-content-start align-items-center g-2">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary"
                                                onclick="resetUt({{ $dataUt->id }})" data-bs-toggle="modal"
                                                data-bs-target="#ModalReset">
                                                {{ 'รีเซ็ตรหัสผ่าน' }}
                                            </button>

                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="editUt({{ $dataUt->id }})"
                                                class="btn btn-warning editUt" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit">
                                                {{ 'แก้ไข' }}
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger delete-item"
                                                data-technician_id="{{ $dataUt->id }}">{{ 'ลบ' }}</button>
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
            <form id="addTechnician" name="addTechnician">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalAddLabel">{{ 'เพิ่มผู้ใช้งานช่าง' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input value="{{ old('name', $DataTu->name) }}" id="name" class="form-control"
                                type="text" name="name" placeholder="ชื่อ - นามสกุล">
                            <div id="error-add-name" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input value="{{ old('email', $DataTu->email) }}" id="email" class="form-control"
                                type="text" name="email" placeholder="อีเมล">
                            <div id="error-add-email" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <select class="form-select" id="department" name="department"
                                aria-label="Default select example">
                                <option value="0" disabled selected>{{ '--เลือกแผนก--' }}</option>
                                @foreach ($Department as $data)
                                    <option value="{{ $data->department_id }}">{{ $data->department_name }}</option>
                                @endforeach
                            </select>
                            <div id="error-add-department" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <select class="form-select" id="level" name="level" aria-label="Default select example">
                                <option value="0" disabled selected>{{ '-- ระดับ --' }}</option>
                                <option value="1">{{ 'หัวหน้า' }}</option>
                                <option value="2">{{ 'พนักงาน' }}</option>
                            </select>
                            <div id="error-add-level" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="password" class="form-control" type="password" name="password"
                                placeholder="รหัสผ่าน">
                            <div id="error-add-password" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="password-confirm" class="form-control" type="password"
                                name="password_confirmation" placeholder="ยืนยันรหัสผ่าน">
                            <div id="error-add-password-confirm" class="form-text text-danger" style="margin-left: 1rem">
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
            <form id="editTechnician">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalEditLabel">แก้ไขผู้ใช้งานช่าง</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input id="nameEdit" class="form-control" type="text" name="name"
                                placeholder="ชื่อ - นามสกุล">
                            <div id="editName" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="emailEdit" class="form-control" type="text" name="email"
                                placeholder="อีเมล">
                            <div id="editEmail" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <select class="form-select" id="edit-department-select" aria-label="Default select example"
                                name="department">{{--  required="" data-parsley-required-message="กรุณาเลือกแผนก" --}}
                                @foreach ($Department as $data)
                                    <option value="{{ $data->department_id }}">{{ $data->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <select class="form-select" id="edit-level-select" aria-label="Default select example"
                                name="level">{{-- required="" data-parsley-required-message="กรุณาเลือกระดับ" --}}

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal-reset -->
    <div class="modal fade" id="ModalReset" tabindex="-1" aria-labelledby="ModalResetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="resetTechnician">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalResetLabel">{{ 'รีเซ็ตรหัสผ่าน' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input id="reset-password" class="form-control" type="password" name="password"
                                placeholder="รหัสผ่าน">
                            <div id="error-reset-password" class="form-text text-danger" style="margin-left: 1rem"></div>
                        </div>
                        <div class="form-group my-2">
                            <input id="reset-password-confirm" class="form-control" type="password"
                                name="password_confirmation" placeholder="ยืนยันรหัสผ่าน">
                            <div id="error-reset-password-confirm" class="form-text text-danger"
                                style="margin-left: 1rem"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary reset-item">บันทึก</button>
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
            document.forms["addTechnician"]["name"].value = "";
            document.forms["addTechnician"]["email"].value = "";
            document.forms["addTechnician"]["department"].value = "0";
            document.forms["addTechnician"]["level"].value = "0";
            document.forms["addTechnician"]["password"].value = "";
            document.forms["addTechnician"]["password_confirmation"].value = "";
            document.getElementById('error-add-name').innerHTML = "";
            document.getElementById('error-add-email').innerHTML = "";
            document.getElementById('error-add-department').innerHTML = "";
            document.getElementById('error-add-level').innerHTML = "";
            document.getElementById('error-add-password').innerHTML = "";
            document.getElementById('error-add-password-confirm').innerHTML = "";

            const formadditUt = document.querySelector('#addTechnician');
            // Determine the URL for the Axios request
            let url =
                "{{ route('store.account.technician') }}";

            let isError = {
                aName: false,
                aEmail: false,
                aDepar: false,
                aLavel: false,
                aPassword: false,
                aConPassword: false,
            };
            let isValid = true;

            formadditUt.addEventListener("submit", (e) => {
                e.preventDefault();
                // Get form data
                let formData = new FormData(document.forms["addTechnician"]);
                const Name = formData.get('name');
                const Email = formData.get('email');
                const Depar = formData.get('department');
                const Lavel = formData.get('level');
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

                if (Depar == null) {
                    isError.aDepar = true;
                    document.getElementById('error-add-department').innerHTML = "กรุณาเลือกแผนก";
                } else {
                    isError.aDepar = false;
                    document.getElementById('error-add-department').innerHTML = "";
                }

                if (Lavel == null) {
                    isError.aLavel = true;
                    document.getElementById('error-add-level').innerHTML = "กรุณาเลือกระดับ";
                } else {
                    isError.aLavel = false;
                    document.getElementById('error-add-level').innerHTML = "";
                }

                if (Password.trim().length < 1) {
                    isError.aPassword = true;
                    document.getElementById('error-add-password').innerHTML = "กรุณาระบุรหัสผ่าน";
                } else {
                    isError.aPassword = false;
                    document.getElementById('error-add-password').innerHTML = "";
                }

                if (ConPassword != Password) {
                    console.log(ConPassword);
                    isError.aConPassword = true;
                    document.getElementById('error-add-password-confirm').innerHTML = "รหัสผ่านไม่ตรง";
                } else {
                    isError.aConPassword = false;
                    document.getElementById('error-add-password-confirm').innerHTML = "";
                }

                const hasError = Object.values(isError).find((err) => err === true);
                hasError ? isValid = false : isValid = true;

                if (isValid) {

                    /* Display the key/value pairs*/
                    // for (var pair of formData.entries()) {
                    //     console.log(pair[0] + ', ' + pair[1]);
                    // }
                    // return false;

                    // Send the Axios request
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

        function editUt(id) {
            if (id) {
                axios.get($url + `/admin/edit/technician/${id}`)
                    .then(function(response) {
                        let data = response.data;
                        console.log(data);
                        document.getElementById("nameEdit").value = data.Technician.name
                        document.getElementById("emailEdit").value = data.Technician.email
                        // ดึงค่า department_id ของ Technician
                        const technicianDepartmentId = data.Technician.department;
                        // กรองข้อมูล Department ที่ตรงกับ department_id ของ Technician
                        const sortedDepartments = data.Department.sort((a, b) => {
                            if (a.department_id === technicianDepartmentId) {
                                // นำข้อมูลที่ตรงกับ technicianDepartmentId ขึ้นมาบนสุด
                                return -1;
                            }
                            if (b.department_id === technicianDepartmentId) {
                                // นำข้อมูลที่ตรงกับ technicianDepartmentId ขึ้นมาบนสุด
                                return 1;
                            }
                            // เรียงลำดับตาม department_id สำหรับข้อมูลที่ไม่ตรงกับ technicianDepartmentId
                            return a.department_id - b.department_id;
                        });
                        console.log(sortedDepartments);
                        // ใส่ข้อมูลลงใน select
                        $('#edit-department-select').html('');
                        sortedDepartments.forEach(function(item) {
                            $('#edit-department-select').append(
                                `<option value="${item.department_id}">${item.department_name}</option>`);
                        });
                        $('#edit-level-select').html('');
                        if (data.Technician.level) {
                            $('#edit-level-select').append(
                                `<option value="1">หัวหน้า</option>
                                <option value="2">พนักงาน</option>`);
                        } else {
                            $('#edit-level-select').append(
                                `<option value="2">พนักงาน</option>
                                <option value="1">หัวหน้า</option>
                                `);
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            let isError = {
                eName: false,
                eEmail: false
            };
            let isValid = true;
            const formeditUt = document.querySelector('#editTechnician');

            formeditUt.addEventListener("submit", (e) => {
                e.preventDefault();
                let formData = new FormData(formeditUt);
                const Name = formData.get('name');
                const Email = formData.get('email');

                if (Name.trim().length < 1) {
                    isError.eName = true;
                    document.getElementById('editName').innerHTML = "กรุณาระบุชื่อ - นามสกุล";
                } else {
                    isError.eName = false;
                    document.getElementById('editName').innerHTML = "";
                }
                if (Email.trim().length < 1) {
                    isError.eEmail = true;
                    document.getElementById('editEmail').innerHTML = "กรุณาระอีเมล";
                } else if (!/^[\w-.]+@[\w-.]+\.[a-zA-Z]{2,}$/.test(Email)) {
                    isError.eEmail = true;
                    document.getElementById('editEmail').innerHTML = "รูปแบบอีเมลไม่ถูกต้อง";
                } else {
                    isError.eEmail = false;
                    document.getElementById('editEmail').innerHTML = "";
                }
                const hasError = Object.values(isError).find((err) => err === true);
                hasError ? isValid = false : isValid = true;

                if (isValid) {
                    axios.post($url + `/admin/user/updateUt/${id}`, formData)
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

        function resetUt(id) {
            document.getElementById('reset-password').value = "";
            document.getElementById('reset-password-confirm').value = "";
            document.getElementById('error-reset-password').innerHTML = "";
            document.getElementById('error-reset-password-confirm').innerHTML = "";
            let isError = {
                rPassword: false,
                rPasswordConfirm: false
            };
            let isValid = true;
            const formResetUt = document.querySelector('#resetTechnician');

            formResetUt.addEventListener("submit", (e) => {
                e.preventDefault();
                let formData = new FormData(formResetUt);

                const ResetPassword = formData.get('password');
                const ResetPasswordConfirm = formData.get('password_confirmation');

                if (ResetPassword.trim().length < 1) {
                    document.getElementById('error-reset-password').innerHTML = "กรุณาระบุรหัสผ่าน";
                    isError.rPassword = true;
                } else if (ResetPassword.trim().length <= 8) {
                    document.getElementById('error-reset-password').innerHTML = "รหัสผ่านต้องมากกว่า 8 ตัว";
                    isError.rPassword = true;
                } else {
                    document.getElementById('error-reset-password').innerHTML = "";
                    isError.rPassword = false;
                }

                if (ResetPasswordConfirm.trim().length < 1) {
                    isError.rPasswordConfirm = true;
                    document.getElementById('error-reset-password-confirm').innerHTML = "กรุณาระบุรหัสผ่าน";
                } else if (ResetPasswordConfirm != ResetPassword) {
                    isError.rPasswordConfirm = true;
                    document.getElementById('error-reset-password-confirm').innerHTML = "ระบุรหัสผ่านไม่ตรง";
                } else {
                    document.getElementById('error-reset-password-confirm').innerHTML = "";
                    isError.rPasswordConfirm = false;
                }


                const hasError = Object.values(isError).find((err) => err === true);
                hasError ? isValid = false : isValid = true;

                if (isValid) {
                    axios.post($url + `/admin/tradesman/reset/password/${id}`, formData)
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
            });
        }

        document.querySelector('#UtTable').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.technician_id);
                let tuId = e.target.dataset.technician_id;
                Swal.fire({
                    title: 'คุณต้องการลบผู้ใช้งานนี้หรือไม่',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ต้องการ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    console.log($url);
                    if (result.isConfirmed) {
                        axios.delete($url + `/admin/tradesman/destroy/` + tuId)
                            .then((response) => {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "ข้อมูลของคุณถูกลบไปแล้ว",
                                    showConfirmButton: false,
                                    timer: 1600,
                                });
                                setTimeout(() => {
                                    window.location.href = "{{ route('technician.index') }}"
                                }, 1600)
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

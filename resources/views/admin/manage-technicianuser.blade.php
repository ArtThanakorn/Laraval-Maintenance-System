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
                <div class="col-3">ผู้ใช้งานช่าง</div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                        <i class="bi bi-plus-square"></i> เพิ่มผู้ใช้งานช่าง
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="UtTable" class="table table-primary">
                    <thead>
                        <tr>
                            <th colspan="col"> ลำดับ </th>
                            <th colspan="col">ชื่อ</th>
                            <th colspan="col">อีเมล</th>
                            <th colspan="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liTechnicianUser as $key => $dataUt)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $dataUt->name }}</td>
                                <td>{{ $dataUt->email }}</td>
                                <td>
                                    <div class="row justify-content-start align-items-center g-2">
                                        <div class="col-auto">
                                            <button type="button" onclick="resetUt({{ $dataUt->id }})"
                                                class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalReset">
                                                รีเซ็ตรหัสผ่าน
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="editUt({{ $dataUt->id }})"
                                                class="btn btn-warning editUt" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit">
                                                แก้ไข
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger delete-item"
                                                data-technician_id="{{ $dataUt->id }}">ลบ</button>
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
            <form id="addTechnician" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalAddLabel">เพิ่มผู้ใช้งานช่าง</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <input value="{{ old('name', $DataTu->name) }}" id="name"
                                @error('name') is-invalid @enderror class="form-control" type="text" name="name"
                                placeholder="ชื่อ - นามสกุล" required="" data-parsley-trigger="change"
                                data-parsley-required-message="กรุณากรอกชื่อ-นามสกุล">
                        </div>
                        <div class="form-group my-2">
                            <input value="{{ old('email', $DataTu->email) }}" id="email" class="form-control"
                                type="text" name="email" placeholder="อีเมล" required=""
                                data-parsley-trigger="change"
                                data-parsley-required-message="กรุณากรอกอีเมล"data-parsley-type-message="รูปแบบอีเมลไม่ถูกต้อง">
                        </div>
                        <div class="form-group my-2">
                            <select class="form-select" name="department" aria-label="Default select example" required=""
                                data-parsley-required-message="กรุณาเลือกแผนก">
                                <option disabled selected>--เลือกแผนก--</option>
                                @foreach ($Department as $data)
                                    <option value="{{ $data->department_id }}">{{ $data->department_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group my-2">
                            <select class="form-select" name="level" aria-label="Default select example" required=""
                                data-parsley-required-message="กรุณาเลือกระดับ">
                                <option disabled selected>-- ระดับ --</option>
                                <option value="1">หัวหน้า</option>
                                <option value="2">พนักงาน</option>
                            </select>
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
            <form id="editTechnician" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalEditLabel">แก้ไขผู้ใช้งานช่าง</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                        <div class="form-group my-2">
                            <select class="form-select" id="edit-department-select" aria-label="Default select example"
                                required="" data-parsley-required-message="กรุณาเลือกแผนก">
                                @foreach ($Department as $data)
                                    <option value="{{ $data->department_id }}">{{ $data->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <select class="form-select" id="edit-level-select" aria-label="Default select example"
                                required="" data-parsley-required-message="กรุณาเลือกระดับ">

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="updateTechnician()" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

     <!-- Modal-reset -->
     <div class="modal fade" id="ModalReset" tabindex="-1" aria-labelledby="ModalResetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addTechnician" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalResetLabel">เพิ่มผู้ใช้งานช่าง</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
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
@endsection

@section('script')
    <script>
        function submitForm() {
            if ($('#addTechnician').parsley().validate()) {
                // Get form data
                let formData = new FormData(document.getElementById('addTechnician'));

                // Determine the URL for the Axios request
                let url =
                    "{{ route('store.account.technician') }}";

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
        }

        let UtId;

        function editUt(id) {
            if (id) {
                axios.get($url + `/admin/edit/technician/${id}`)
                    .then(function(response) {
                        let data = response.data;
                        console.log(data);
                        UtId = data.Technician.id;
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
        }

        function updateTechnician() {
            if ($('#editTechnician').parsley().validate()) {
                console.log(UtId);
                const formData = new FormData();
                formData.append('ut_name', document.getElementById("nameEdit").value);
                formData.append('ut_email', document.getElementById("emailEdit").value);
                formData.append('ut_department', document.getElementById("edit-department-select").value);
                formData.append('ut_level', document.getElementById("edit-level-select").value);

                axios.post($url + `/admin/user/updateUt/${UtId}`, formData)
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
        }

        function resetUt() {
console.log('123');
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

@extends('layout.master')

@section('style')
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .parsley-required {
            color: red;
            padding: 8px;
        }

        .bi-toggle2-on{
            color: #2D31FA;
        }
    </style>
@endsection

@section('content')
    <div class="Departmentconten p-3 ">
        <div class="row justify-content-center align-items-start g-2">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <p class="fs-4">รายชื่อแผนก</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                            <i class="bi bi-plus-square"></i> เพิ่มรายชื่อแผนก
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-md-1">id</th>
                                        <th scope="col">ชื่อแผนก</th>
                                        <th scope="col">แสดงผล</th>
                                        <th scope="col" class="col-md-4">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $row)
                                        <tr class="">
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $row->department_name }}</td>
                                            <td>
                                                @if ($row->status_display == 0)
                                                <h2><i class="bi bi-toggle2-on"></i> </h2>@else<h2> <i
                                                            class="bi bi-toggle2-off"></i> </h2>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row justify-content-start align-items-center g-2">
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            onclick="editDepartmentName({{ $row->department_id }})"
                                                            class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#ModalEdit">
                                                            แก้ไข
                                                        </button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="btn btn-danger">
                                                            ลบ
                                                        </button>
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
            </div>
    </div>

    <!-- Modal-add -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="ModalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addDepartment" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalAddLabel">เพิ่มรายชื่อแผนก</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">ชื่อแผนก</label>
                            <input type="text" name="departmentName" id="departmentName" class="form-control"
                                placeholder="" aria-describedby="helpId" required=""
                                data-parsley-required-message="กรุณากรอกชื่อแผนก">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="saveDepartmentName()" class="btn btn-primary">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal-edit -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editDepartment" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalEditLabel">แก้ไขรายชื่อแผนก</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-start align-items-center g-2 mb-2">
                            <div class="col-12">
                                <label for="" class="form-label">ชื่อแผนก</label>
                                <input type="text" name="departmentName" id="departmentNameEdit" class="form-control"
                                    placeholder="" aria-describedby="helpId" required=""
                                    data-parsley-required-message="กรุณากรอกชื่อแผนก">
                            </div>
                        </div>
                        <div class="row justify-content-start align-items-center g-2 ">
                            <div class="col-6 "> 
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">แสดงผล</label>
                                     <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck">
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="updateDepartment()" class="btn btn-primary">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function saveDepartmentName() {
            if ($('#addDepartment').parsley().validate()) {
                // Get form data
                let departmentName = document.getElementById("departmentName").value;
                console.log(departmentName);

                // Determine the URL for the Axios request
                let url =
                    "{{ route('D.create') }}";

                axios.post(url, {
                        department_name: departmentName
                    })
                    .then(function(response) {
                        console.log(response);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1600)
                    })
                    .catch(function(error) {
                        console.log(error);
                    });

            }
        }

        let departmentId;
       
        function editDepartmentName(id) {
            // console.log(id);
            if (id) {
                axios.post($url + `/admin/department/edit/${id}`)
                    .then(function(response) {
                        let data = response.data;
                        departmentId = data.department_id;
                        let departmentName = data.department_name;
                        document.getElementById("departmentNameEdit").value = departmentName;
                        // console.log(data.status_display);
                        // ตรวจสอบสถานะและกำหนดค่าของสวิตช์
                        let switchCheck = document.getElementById('SwitchCheck');
                        switchCheck.innerHTML = ''; // เคลียร์เนื้อหาเดิม
                        if (data.status_display === 0) {
                            switchCheck.checked = true;
                            switchCheck.value = 0 ;
                        }else{
                            switchCheck.checked = false;
                            switchCheck.value = 1 ;
                        }
                        console.log(switchCheck.value);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });

            }
        }

        function updateDepartment() {
            // console.log(departmentId);
            if ($('#editDepartment').parsley().validate()) {
                // Get form data
                let departmentNameupDate = document.getElementById("departmentNameEdit").value;
                let departmentStatusDisplay = document.getElementById("SwitchCheck").checked ? 0 : 1; // เปลี่ยนจาก value เป็น checked และกำหนดค่าตามเงื่อนไข

               axios.post($url + `/admin/department/update/${departmentId}`, {
                        name: departmentNameupDate,
                        display: departmentStatusDisplay
                    })
                    .then(function(response) {
                        console.log(response);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500)
                    })
                    .catch(function(error) {
                        console.log(error);
                    });

            }
        }
    </script>
@endsection

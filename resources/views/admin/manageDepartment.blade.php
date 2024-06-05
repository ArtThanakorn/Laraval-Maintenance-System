@extends('layout.master')

@section('style')
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
    </style>
@endsection

@section('content')
    <div class="Departmentconten p-3 ">
        <div class="row justify-content-center align-items-start g-2">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <p class="fs-4">{{ 'รายชื่อแผนก' }}</p>
                        <button type="button" class="btn btn-primary" onclick="addDepartmentName()" data-bs-toggle="modal"
                            data-bs-target="#ModalAdd">
                            <i class="bi bi-plus-square"></i> {{ 'เพิ่มรายชื่อแผนก' }}
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="deparTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-md-1">{{ 'id' }}</th>
                                        <th scope="col">{{ 'ชื่อแผนก' }}</th>
                                        <th scope="col">{{ 'แสดงผล' }}</th>
                                        <th scope="col" class="col-md-4">{{ 'จัดการ' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $row)
                                        <tr class="">
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $row->department_name }}</td>
                                            <td>
                                                @if ($row->status_display == 0)
                                                    <h2><i class="bi bi-toggle2-on"></i> </h2>
                                                @else
                                                    <h2> <i class="bi bi-toggle2-off"></i> </h2>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row justify-content-start align-items-center g-2">
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            onclick="editDepartment({{ $row->department_id }})"
                                                            class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#ModalEdit">
                                                            {{ 'แก้ไข' }}
                                                        </button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="destroyDepar({{ $row->department_id }})"
                                                            data-deparTable_id="{{ $row->department_id }}">
                                                            {{ 'ลบ' }}
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
                <form id="addDepartment">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalAddLabel">{{ 'เพิ่มรายชื่อแผนก' }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">{{ 'ชื่อแผนก' }}</label>
                                <input type="text" name="departmentName" id="departmentName" class="form-control"
                                    placeholder="ชื่อแผนก">
                                <div id="error-add-depar" class="form-text text-danger" style="margin-left: 1rem"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="sbtDepartment()">{{ 'บันทึก' }}</button>
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
                <form id="editDepartment">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalEditLabel">{{ 'แก้ไขรายชื่อแผนก' }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-start align-items-center g-2 mb-2">
                                <div class="col-12">
                                    <label for="" class="form-label">{{ 'ชื่อแผนก' }}</label>
                                    <input type="text" name="departmentNameEdit" id="departmentNameEdit"
                                        class="form-control" placeholder="ชื่อแผนก">
                                    <div id="error-edit-depar" class="form-text text-danger" style="margin-left: 1rem">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-start align-items-center g-2 ">
                                <div class="col-6 ">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label"
                                            for="flexSwitchCheckDefault">{{ 'แสดงผล' }}</label>
                                        <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck"
                                            name="switchEdit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="buUpWork" class="btn btn-primary">{{ 'บันทึก' }}</button>
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ 'ยกเลิก' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            function addDepartmentName() {
                document.getElementById('departmentName').value = "";
                document.getElementById('error-add-depar').innerHTML = "";

            }

            function sbtDepartment() {
                // Determine the URL for the Axios request
                let url = "{{ route('D.create') }}";

                const formaddDt = document.querySelector('#addDepartment');
                let isError = {
                    aDepar: false,
                };

                let isValid = true;

                
                    // Get form data
                    let formData = new FormData(formaddDt);

                    const Depar = formData.get('departmentName');

                    if (Depar.trim().length < 1) {
                        isError.aDepar = true;
                        document.getElementById('error-add-depar').innerHTML = "กรุณากรอกชื่อแผนก";
                    } else {
                        isError.aDepar = false;
                        document.getElementById('error-add-depar').innerHTML = "";
                    }

                    const hasError = Object.values(isError).find((err) => err === true);
                    hasError ? isValid = false : isValid = true;

                    if (isValid) {
                        /* Display the key/value pairs*/
                        // for (var pair of formData.entries()) {
                        //     console.log(pair[0] + ', ' + pair[1]);
                        // }
                        // return false;

                        axios.post(url, formData)
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
                                }, 1600)
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    }
                
            }

            function editDepartment(id) {
                document.getElementById('error-edit-depar').innerHTML = "";
                if (id) {
                    axios.post($url + `/admin/department/edit/${id}`)
                        .then(function(response) {
                            let data = response.data;
                            let departmentName = data.department_name;
                            document.getElementById("departmentNameEdit").value = departmentName;
                            // console.log(data.status_display);
                            // ตรวจสอบสถานะและกำหนดค่าของสวิตช์
                            let switchCheck = document.getElementById('SwitchCheck');
                            switchCheck.innerHTML = ''; // เคลียร์เนื้อหาเดิม
                            if (data.status_display === 0) {
                                switchCheck.checked = true;
                                switchCheck.value = 0;
                            } else {
                                switchCheck.checked = false;
                                switchCheck.value = 1;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                } else {
                    console.log("ไม่มีidเข้ามา");
                }

                const formeditDt = document.querySelector('#editDepartment');
                let isError = {
                    eDepar: false,
                };
                let isValid = true;

                const buUpWorkButton = document.getElementById('buUpWork');
// Remove any existing event listener to prevent multiple submissions
                    const newBuUpWorkButton = buUpWorkButton.cloneNode(true);
                    buUpWorkButton.parentNode.replaceChild(newBuUpWorkButton, buUpWorkButton);

                    newBuUpWorkButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    let formData = new FormData(formeditDt);
                    const Depar = formData.get('departmentNameEdit');
                    const Swit = formData.get('switchEdit');

                    if (Depar.trim().length < 1) {
                        isError.eDepar = true;
                        document.getElementById('error-edit-depar').innerHTML = "กรุณากรอกชื่อแผนก";
                    } else {
                        isError.eDepar = false;
                        document.getElementById('error-edit-depar').innerHTML = "";
                    }

                    if (!Swit) {
                        formData.append('switchEdit', 1);
                    } else {
                        formData.append('switchEdit', 0);
                    }

                    const hasError = Object.values(isError).find((err) => err === true);
                    hasError ? isValid = false : isValid = true;

                    if (isValid) {
                        /* Display the key/value pairs*/
                        // for (var pair of formData.entries()) {
                        //     console.log(pair[0] + ', ' + pair[1]);
                        // }
                        // return false;

                        axios.post($url + `/admin/department/update/${id}`, formData)
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

                })
            }

            function destroyDepar(id) {
                console.log(id);
                Swal.fire({
                    title: 'คุณต้องการลบแผนกนี้หรือไม่',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ต้องการ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    console.log($url);
                    if (result.isConfirmed) {
                        axios.delete($url + `/admin/department/destroy/${id}`)
                            .then((response) => {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "ข้อมูลของคุณถูกลบไปแล้ว",
                                    showConfirmButton: false,
                                    timer: 1600,
                                });
                                setTimeout(() => {
                                    window.location.href = "{{ route('D.index') }}"
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
            /*document.querySelector('#deparTable').addEventListener('click', (e) => {
                    if (e.target.matches('.delete-item')) {
                        console.log('123');
                        console.log(e.target.dataset.deparTable_id);
                        let DepaId = e.target.dataset.deparTable_id;
                     
                    }
                });*/
        </script>
    @endsection

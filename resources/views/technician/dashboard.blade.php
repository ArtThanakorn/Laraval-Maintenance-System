@extends('layout.master')

@section('style')
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        div.dt-container .dt-paging .dt-paging-button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.125rem;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: inherit !important;
            /* border: 1px solid transparent; */
            /* border-radius: 2px; */
            background: transparent
        }

        .dataTables_paginate .paginate_button.hover {
            background-color: #000;
            border-color: #000;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    {{--  เริ่มการ์ดด้านบน  --}}
    {{-- <div class="container my-3">
            <div class="row ">
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-tasks fa-3x text-info"></i>
                                <div class="text-end text-secondary">
                                    <h5>ดูรายการเเจ้งซ่อม</h5>
                                    <h3>12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href=""></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-wrench fa-3x text-warning"></i>
                                <div class="text-end text-secondary">
                                    <h5>จัดการงานเเจ้งซ่อม</h5>
                                    <h3>12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href=""></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-check-circle fa-3x text-success"></i>
                                <div class="text-end text-secondary">
                                    <h5>ซ่อมเสร็จเเล้ว</h5>
                                    <h3>12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href=""></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    {{--  จบการ์ด ด้านบน  --}}

    {{--  เริ่มตาราง  --}}
    <div class="container">
        <h3 class="mt-4">ตารางข้อมูลรายการเเจ้งซ่อม</h3>
        <div class="row justify-content-center align-items-center g-2 mb-3">
            <div class="card">
                <div class="row justify-content-between align-items-center g-2 mt-2 ">

                    <div class="d-flex justify-content-center mb-3">
                        <div class="p-2">
                            <div class="flex" style="width: 2.5cm; margin-left: 14px;">
                                <select id="per-page" class="form-select" aria-label="Default select example"
                                    onchange="entries()">

                                    <option value="10" {{ $p == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25"{{ $p == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50"{{ $p == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100"{{ $p == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                        </div>
                        <div class="me-auto p-2">
                            <div class="flex" style="padding-block: inherit;">
                                {{ __('รายการต่อหน้า') }}
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="flex" style="width:5cm">
                                <select class="form-select" id="status-repair" aria-label="Default select example"
                                    onchange="statusRepair()">
                                    <option selected disabled>{{ 'สถานะงานเเจ้งซ่อม' }}</option>
                                    <option value="เนินการเสร็จสิ้น">{{ __('เนินการเสร็จสิ้น') }}</option>
                                    <option value="รอดำเนินการ">{{ __('รอดำเนินการ') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-2">

                            <div class="col-auto">
                                <form action="{{ route('technician.dashboard', ['p' => 10], request()->query()) }}">
                                    <div class="flex">
                                        <input type="text" name="q" placeholder="Search"
                                            class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none"
                                            value="{{ $search_param }}" />
                                        <button type="submit"
                                            class="w-10 flex items-center justify-center border-t border-r border-b border-gray-200 rounded-r text-gray-100 bg-blue-500">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @dd($users) --}}

                <div class="card-body">
                    <table class="table table-bordered mb-5">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ผู้แจ้งซ่อม</th>
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">สถานที่</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workData as $key => $data)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->details }}</td>
                                    <td>{{ $data->site }}</td>
                                    <td>{{ $data->status_repair }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-mdb-ripple-init
                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                            onclick="openEditModal({{ $key }})">{{ 'แก้ไข' }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {!! $workData->links('layout.pagination-custom') !!}
                    </div>
                    {{--  จบตาราง  --}}
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="form-technician">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">ผู้แจ้งซ่อม</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="editModalName" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">สถานะ</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="editModalStatus" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">สถานที่</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="editModalSite" readonly>
                                            {{-- <input type="text" class="form-control" name="inputName" id="editModalSite" 
                                                placeholder="Name" > --}}
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">รายละเอียด</label>
                                        <div class="col-8">
                                            <textarea class="form-control" id="editModalDetails" rows="3" readonly></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">ส่งงานไปยัง</label>
                                        <div class="col-8">
                                            <select class="form-select" id="department-select"
                                                aria-label="Default select example" name="newdepartment">
                                                @foreach ($department as $row)
                                                    <option value="{{ $row->department_id }} ">
                                                        {{ $row->department_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="editModalId" name="id">
                                    {{-- <fieldset class="mb-3 row">
                                        <legend class="col-form-legend col-4">
                                            Group name
                                        </legend>
                                        <div class="col-8">
                                            you can use radio and checkboxes here
                                        </div>
                                    </fieldset>
                                    <div class="mb-3 row">
                                        <div class="offset-sm-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">
                                                Action
                                            </button>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="submitForm()"
                                    class="btn btn-primary">{{ 'บันทึก' }}</button>
                                {{-- <button type="submit" class="btn btn-primary">Save changes</button> --}}
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
                function submitForm() {
                    // Get form data
                    let formData = new FormData(document.getElementById('form-technician'));
                    /* Display the key/value pairs*/
                    // for (var pair of formData.entries()) {
                    //     console.log(pair[0] + ', ' + pair[1]);
                    // }
                    // return false;
                    // Determine the URL for the Axios request
                    let url = "{{ route('moveswork') }}";

                    // Send the Axios request
                    axios.post(url, formData)
                        .then(function(response) {
                            // Handle the success response if needed
                            console.log(response.data);
                            Swal.fire({
                                title: "Success!",
                                text: "You clicked the button!",
                                icon: "success"
                            }).then((result) => {
                                location.href = $url+"/technician/dashboard/10";
                            });
                        })
                        .catch(function(error) {
                            // Handle the error response if needed
                            console.error(error);
                        });

                }

                function entries() {
                    let p = document.getElementById('per-page').value;
                    console.log(p);
                    window.location.replace($url + `/technician/dashboard/${p}`);
                    // axios.get($url +`/technician/dashboard/${p}`)
                    //     .then(function(response) {
                    //         location.reload();
                    //     })
                    //     .catch(function(error) {
                    //         console.log(error);
                    //     });
                }

                const department = {!! json_encode($department) !!};

                function openEditModal(index) {
                    // ดึงข้อมูลจากตัวแปร $workData ที่ได้รับมาจาก Laravel
                    var workData = <?php echo json_encode($workData); ?>;

                    // ดึงข้อมูลของแถวที่เลือก
                    var selectedData = workData.data[index];
                    console.log(selectedData);
                    // แสดงข้อมูลใน Modal
                    const modalDataDetails = document.getElementById('editModalDetails').value = selectedData.details;
                    const modalDataSite = document.getElementById('editModalSite').value = selectedData.site;
                    const modalDataStatus = document.getElementById('editModalStatus').value = selectedData.status_repair;
                    const modalDataName = document.getElementById('editModalName').value = selectedData.name;
                    const modalDataId = document.getElementById('editModalId').value = selectedData.id_repair;

                    // Select the 'select' element with ID 'department-select'
                    const departmentSelectElement = document.getElementById('department-select');

                    // const selectElement = document.querySelector('.department-select');

                    departmentSelectElement.innerHTML = '';
                    console.log(department);

                    for (const row of department) {
                        const optionElement = document.createElement('option');
                        optionElement.value = row.department_id;
                        optionElement.textContent = row.department_name;

                        // Set 'selected' attribute based on condition
                        if (row.department_id == selectedData.type) {
                            optionElement.selected = true;
                            optionElement.disabled = true;
                        }

                        departmentSelectElement.appendChild(optionElement);
                    }
                }

                function statusRepair() {
                    let s = document.getElementById('status-repair').value;
                    console.log(s);
                    let p = document.getElementById('per-page').value;
                    let queryParam = encodeURIComponent(s); // แปลงค่า s เป็นรูปแบบที่เหมาะสำหรับ query parameter
                    let url = "{{ url('technician/dashboard') }}/" + p + "?status=" + queryParam;
                    window.location.href = url;
                }
            </script>
        @endsection

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

        .img-thumbnail {
            width: 250px;
            height: 200px;
        }

        .senWorkContent {
            max-width: 90%;
        }
    </style>
@endsection

@section('content')
    {{--  เริ่มตาราง  --}}
    <div class="container">
        <h3 class="mt-4">{{ 'ตารางข้อมูลรายการเเจ้งซ่อม' }}</h3>
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
                                    {{-- <option selected disabled>{{ 'สถานะงานเเจ้งซ่อม' }}</option> --}}
                                    <option value="ทั้งหมด" selected>{{ __('ทั้งหมด') }}</option>
                                    <option value="ดำเนินการเสร็จสิ้น"
                                        {{ isset($_GET['status']) && $_GET['status'] == 'ดำเนินการเสร็จสิ้น' ? 'selected' : '' }}>
                                        {{ __('ดำเนินการเสร็จสิ้น') }}</option>
                                    <option value="รอดำเนินการ"
                                        {{ isset($_GET['status']) && $_GET['status'] == 'รอดำเนินการ' ? 'selected' : '' }}>
                                        {{ __('รอดำเนินการ') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-2">

                            <div class="col-auto">
                                <div class="flex">
                                    <input type="text" id="inpufil" name="q" placeholder="Search"
                                        class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none"
                                        value="{{ $search_param }}" onchange="filterRepairWork()" />
                                    {{-- <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @dd($users) --}}

                <div class="card-body">
                    <table class="table table-bordered mb-5">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">{{ 'ลำดับ' }}</th>
                                <th scope="col">{{ 'ผู้แจ้งซ่อม' }}</th>
                                <th scope="col">{{ 'รายละเอียด' }}</th>
                                <th scope="col">{{ 'สถานที่' }}</th>
                                <th scope="col">{{ 'สถานะ' }}</th>
                                <th scope="col">{{ 'จัดการ' }}</th>
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
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#senWork" onclick="openSendWork({{ $key }})">
                                            {{ 'ส่งงาน' }}
                                        </button>
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
            <!-- Modal โบ้ยงาน -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="form-technician">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">เเก้ไขข้อมูลเเจ้งซ่อม</h1>
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

            <!-- Modal ส่งงาน -->
            <div class="modal fade" id="senWork" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg senWorkContent">
                    <div class="modal-content">
                        <form id="upDateWork" class="contentimg">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ 'ส่งงาน' }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="max-height: 500px">
                                <div class="row justify-content-center align-items-start g-2">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="FormControlInputName"
                                                class="form-label">{{ 'ผู้แจ้งซ่อม' }}</label>
                                            <input type="text" class="form-control" id="updateName" placeholder=""
                                                readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="FormControlInputSite"
                                                class="form-label">{{ 'สถานที่' }}</label>
                                            <input type="email" class="form-control" id="updateSite" placeholder=""
                                                readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="FormControlTextareaDetails"
                                                class="form-label">{{ 'รายละเอียด' }}</label>
                                            <textarea class="form-control" id="updateDetails" rows="2" readonly></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="FormControlInputStatus"
                                                class="form-label">{{ 'สถานะ' }}</label>
                                            {{-- <input type="email" class="form-control" id="updateStatus" placeholder=""
                                            readonly> --}}
                                            <select class="form-select" aria-label="Default select example"
                                                id="updateWork-level-select" name="updateWork_select">
                                                {{-- <option selected>Open this select menu</option> --}}
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">{{ 'อัพเดทงานซ่อม' }}</label>
                                            <input class="form-control" type="file" id="formFile" name="imfupdate[]"
                                                multiple>
                                        </div>
                                        <div class="row justify-content-start align-items-start g-2">
                                            <div class="col-auto text-center">
                                                <div id="image-preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center ">
                                        <div id="updateimg">

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">{{ 'อัพเดท' }}</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ 'ปิด' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection

        @section('script')
            <script>
                function submitForm() {
                    // Get form data
                    let formData = new FormData(document.getElementById('form-technician'));

                    // Determine the URL for the Axios request
                    let url = "{{ route('moveswork') }}";

                    // Send the Axios request
                    axios.post(url, formData)
                        .then(function(response) {
                            // Handle the success response if needed
                            console.log(response.data);
                            Swal.fire({
                                title: "แก้ไขงานสำเสร็จ",
                                text: "คลิกที่ปุ่มตกลง",
                                icon: "success"
                            }).then((result) => {
                                location.href = $url + "/technician/dashboard/10";
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
                }

                const department = {!! json_encode($department) !!};
                // ดึงข้อมูลจากตัวแปร $workData ที่ได้รับมาจาก Laravel
                let workData = <?php echo json_encode($workData); ?>;

                function openEditModal(index) {
                    // ดึงข้อมูลของแถวที่เลือก
                    let selectedData = workData.data[index];
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

                // const formUpDateWork = document.getElementById('upDateWork');

                function openSendWork(index) {
                    const imageInput = document.getElementById('formFile');
                    const imagePreviewContainer = document.getElementById('image-preview');
                    let selectedDataWork = workData.data[index];
                    document.getElementById('updateWork-level-select').innerHTML = "";
                    imageInput.value = "";

                    console.log(selectedDataWork);

                    // Clear existing preview images
                    imagePreviewContainer.innerHTML = '';

                    // Show data in Modal
                    document.getElementById('updateName').value = selectedDataWork.name;
                    // document.getElementById('updateStatus').value = selectedDataWork.status_repair;
                    document.getElementById('updateSite').value = selectedDataWork.site;
                    document.getElementById('updateDetails').value = selectedDataWork.details;
                    const updateImg = document.getElementById('updateimg');
                    updateImg.innerHTML = '';
                    for (const image of selectedDataWork.image_repair) {
                        // console.log(image.nameImage); (Optional for debugging)
                        const imageElement = document.createElement('img');
                        imageElement.classList.add("img-thumbnail", "mb-2"); // Add classes for styling (optional)
                        imageElement.src = `/uploads/repair/${image.nameImage}`; // Assuming image data is in base64 format
                        updateImg.appendChild(imageElement);
                    }

                    if (selectedDataWork.status_repair == "รอดำเนินการ") {
                        $('#updateWork-level-select').append(
                            `<option value="รอดำเนินการ">รอดำเนินการ</option>
                             <option value="ดำเนินการเสร็จสิ้น">ดำเนินการเสร็จสิ้น</option>`);
                    } else {
                        $('#updateWork-level-select').append(
                            `<option value="ดำเนินการเสร็จสิ้น" selected>ดำเนินการเสร็จสิ้น</option>`);
                    }

                    const formUpDateWork = document.querySelector('#upDateWork');

                    imageInput.addEventListener('change', function() {
                        const files = this.files;
                        imagePreviewContainer.innerHTML = ''; // Clear previews again here

                        for (const file of files) {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                const imageElement = document.createElement('img');
                                imageElement.src = event.target.result;
                                imageElement.style.height = "150px";
                                imageElement.classList.add("mx-2");
                                imagePreviewContainer.appendChild(imageElement);
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    formUpDateWork.addEventListener("submit", (e) => {
                        e.preventDefault();

                        const files = imageInput.files;
                        let formData = new FormData(formUpDateWork);


                        /* Display the key/value pairs*/
                        for (var pair of formData.entries()) {
                            console.log(pair[0] + ', ' + pair[1]);
                        }
                        // return false;

                        axios.post($url + `/technician/update/work/${selectedDataWork.id_repair}`, formData).then(
                            function(response) {
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
                            }
                        ).catch(function(error) {
                            // Handle the error response if needed
                            console.error(error);
                        });
                    });
                }

                function filterRepairWork() {
                    let s = document.getElementById('status-repair').value;
                    let p = document.getElementById('per-page').value;
                    let i = document.getElementById('inpufil').value;
                    let queryParam = encodeURIComponent(s);
                    let inpuParam = encodeURIComponent(i);
                    let url = $url + `/technician/dashboard/` + p + "?status=" + queryParam + "&q=" + inpuParam;
                    console.log(url);
                    window.location.href = url;
                }
            </script>
        @endsection

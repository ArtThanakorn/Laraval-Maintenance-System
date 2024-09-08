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
        .container-fluid {
            margin-top: 42rem !important;
          }
    </style>
@endsection
@section('content')
<div class="container-fluid">

    <div class="row justify-content-center align-items-center g-2 mb-3 ">
        <div class="card">
            {{-- <div class="p-2">
                <div class="flex" style="width: 2.5cm; margin-left: 14px;">
                    <select id="per-page" class="form-select" aria-label="Default select example" onchange="entries()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25"{{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50"{{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100"{{ $perPage== 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div> --}}
            <div class="d-flex justify-content-center mb-3">
                <div class="p-2">
                    <div class="flex" style="width: 2.5cm; margin-left: 14px;">
                        <select id="per-page" class="form-select" aria-label="Default select example" onchange="entries()">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25"{{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50"{{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100"{{ $perPage == 100 ? 'selected' : '' }}>100</option>
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
                            {{-- <option value="สถานะงานเเจ้งซ่อม" selected disabled>{{ 'สถานะงานเเจ้งซ่อม' }}</option> --}}
                            <option value="ทั้งหมด" selected
                                {{ isset($_GET['status']) && $_GET['status'] == 'ทั้งหมด' ? 'selected' : '' }}>
                                {{ __('ทั้งหมด') }}</option>
                            <option
                                value="ดำเนินการเสร็จสิ้น"{{ isset($_GET['status']) && $_GET['status'] == 'ดำเนินการเสร็จสิ้น' ? 'selected' : '' }}>
                                {{ __('ดำเนินการเสร็จสิ้น') }}</option>
                            <option
                                value="รอดำเนินการ"{{ isset($_GET['status']) && $_GET['status'] == 'รอดำเนินการ' ? 'selected' : '' }}>
                                {{ __('รอดำเนินการ') }}</option>
                        </select>
                    </div>
                </div>
                <div class="p-2">
                    <div class="col-auto">
                        <div class="flex">
                            <input type="text" name="q" placeholder="Search" id="inpufil"
                                class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none"
                                value="{{ $inupfilter }}" onchange="filterRepair()" />{{-- value="{{ $search_param }}" --}}
                            {{-- <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">{{ 'ลำดับ' }}</th>
                            <th scope="col">{{ 'ประเภทงานซ่อม' }}</th>
                            <th scope="col">{{ 'ชื่อผู้แจ้งซ่อม' }}</th>
                            <th scope="col">{{ 'รายละเอียดงานซ่อม' }}</th>
                            <th scope="col">{{ 'สถานที่' }}</th>
                            <th scope="col">{{ 'รหัสแจ้งซ่อม' }}</th>
                            <th scope="col">{{ 'สถานะงานเเจ้งซ่อม' }}</th>
                            <th scope="col">{{ 'วันที่แจ้งซ่อม' }}</th>
                            <th scope="col">{{ 'จัดการงานซ่อม' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($repairs[0]) --}}
                        @foreach ($repairs as $key => $data)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $data['department_name'] }}</td>
                                <td>{{ $data['name'] }}</td>
                                <td>{{ $data['details'] }}</td>
                                <td>{{ $data['site'] }}</td>
                                <td>{{ $data['tag_repair'] }}</td>
                                <td @if ($data['status_repair'] == 'รอดำเนินการ')
                                    style="color:#e04523"
                                    @else
                                    style="color: #5c9409"
                                @endif>{{ $data['status_repair'] }}</td>
                                <td>{{ $data['created_at'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-whatever="{{ $data['id_repair'] }}"
                                        onclick="openmodal1({{ $key }})">{{ 'แก้ไข' }}</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {!! $repairs->links('layout.pagination-custom') !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <form id="edit-work-repair">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ 'จัดการงานซ่อม' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <p id="name-repair"></p>
                                </div>
                                <div class="mb-3">
                                    <p id="tool-repair"></p>
                                </div>
                                <div class="mb-3">
                                    <p id="room-repair"></p>
                                </div>
                                <div class="mb-3">
                                    <p id="tag-repair"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ 'ประเภทงานซ่อม' }}</label>
                                    <select class="form-select" name="depart_id" id="department-select">
                                        <option selected disabled>{{ '--เลือกประเภทงานซ่อม--' }}</option>
                                        @foreach ($branch_department as $departments)
                                            <option value="{{ $departments->department_id }}">
                                                {{ $departments->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="id_repair" id="edit-repair-id">
                            </div>
                        </div>
                        <div id="updateimg" class="row  g-2">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="formSubmit()">หมอบหมายงาน</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @dd($jChart) --}}
    <div class="row justify-content-center align-items-center g-2 mb-3" style="max-height: 500px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>{{ 'จำนวนงานแยกตามแผนก' }}</p>
                    <canvas id="graphCanvas"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>{{ 'จำนวนงานแยกตามสถานะ' }}</p>
                    <canvas id="graphCanvas2"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
    @endsection
    @section('script')
        <script type="module">
            let jsData = {!! json_encode($jChart) !!};
            let allwork ={!! json_encode($worlALL) !!};
            // console.log(jsData.datasets1.data.work);
            console.log(allwork);

            // เก็บค่า department_name ใน array ใหม่
            const labels = [];
            const Numberofjobs = [];
            for (const item of jsData.datasets1.data) {
                labels.push(item.department_name +" "+ Math.floor((item.work/allwork)*100)+'%');
                Numberofjobs.push( Math.floor((item.work/allwork)*100));
            }
            console.log(Numberofjobs);
            let ctx = document.getElementById('graphCanvas').getContext('2d');
            let ctx2 = document.getElementById('graphCanvas2').getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: Numberofjobs,
                        backgroundColor: jsData.datasets1.backgroundColor,
                        hoverOffset: 4,
                        borderWidth: 1,
                    }]
                },
                options: {
                    legend: {
                        display: true,
                        position: "bottom"
                    }
                }
            });

        //ผลรวมงานทั้งหมด
        let jscompleted = {!! json_encode($ChartWorkcompleted) !!};
        let jsnotcompleted = {!! json_encode($ChartWorknotcompleted) !!};
        let myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['งานที่ยังไม่เสร็จ', 'งานที่เสร็จแล้ว'],
                datasets: [{
                    data: [jsnotcompleted, jscompleted],
                    backgroundColor: jsData.datasets2.backgroundColor,
                    hoverOffset: 4,
                    borderWidth: 1,
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: "right"
                }
            }
        });
    </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const exampleModal = document.getElementById('exampleModal')
                exampleModal.addEventListener('show.bs.modal', event => {
                    // Button that triggered the modal
                    const button = event.relatedTarget
                    // Extract info from data-bs-* attributes
                    const recipient = button.getAttribute('data-bs-whatever')
                    // If necessary, you could initiate an AJAX request here
                    // and then do the updating in a callback.
                    //
                    // Update the modal's content.
                    console.log(recipient);
                    // const modalTitle = exampleModal.querySelector('.modal-title')
                    const modalBodyInput = exampleModal.querySelector('#edit-repair-id')

                    // modalTitle.textContent = `New message to ${recipient}`
                    modalBodyInput.value = recipient;
                })
            });

            function entries() {
                let pPage = document.getElementById('per-page').value;
                console.log(pPage);
                window.location.replace($url + `/admin/show/repair/${pPage}`);
            }

            function statusRepair() {
                let s = document.getElementById('status-repair').value;
                console.log(s);
                let p = document.getElementById('per-page').value;
                let queryParam = encodeURIComponent(s); // แปลงค่า s เป็นรูปแบบที่เหมาะสำหรับ query parameter
                let url = $url + `/admin/show/repair/` + p + "?status=" + queryParam;
                window.location.href = url;
            }

            function filterRepair() {
                let s = document.getElementById('status-repair').value;
                let p = document.getElementById('per-page').value;
                let i = document.getElementById('inpufil').value;
                let queryParam = encodeURIComponent(s);
                let inpuParam = encodeURIComponent(i);
                let url = $url + `/admin/show/repair/` + p + "?status=" + queryParam + "&q=" + inpuParam;
                console.log(url);
                window.location.href = url;
            }

            let current_page_items = {!! json_encode($repairs) !!};
            let branchDepartment = {!! json_encode($branch_department) !!};

            function openmodal1(rows) {
                let data = current_page_items.data[rows];
                console.log(data.image_repair);
                const updateImg = document.getElementById('updateimg');
                updateImg.innerHTML = '';
                document.getElementById('name-repair').innerHTML = "ชื่อ " + data.name;
                document.getElementById('tool-repair').innerHTML = "อุปกรณ์ " + data.equipment;
                document.getElementById('room-repair').innerHTML = "ห้อง " + data.site;
                document.getElementById('tag-repair').innerHTML = "รหัสแจ้งซ่อม " + data.tag_repair;
                //โชรูป
                for (const image of data.image_repair) {
                    // สร้าง div ใหม่
                    const colDiv = document.createElement('div');
                    colDiv.classList.add('col-3', 'text-center');

                    // สร้าง img ใหม่
                    const imageElement = document.createElement('img');
                    imageElement.classList.add('img-thumbnail', 'mb-2');
                    imageElement.src = `/uploads/repair/${image.nameImage}`;

                    // เพิ่ม img เข้าไปใน div
                    colDiv.appendChild(imageElement);

                    // เพิ่ม div เข้าไปใน updateImg
                    updateImg.appendChild(colDiv);
                }
                const departmentSelectElement = document.getElementById('department-select');

                departmentSelectElement.innerHTML = '';

                for (const row of branchDepartment) {
                    const optionElement = document.createElement('option');
                    optionElement.value = row.department_id;
                    optionElement.textContent = row.department_name;

                    // Set 'selected' attribute based on condition
                    if (row.department_id == data.type) {
                        optionElement.selected = true;
                        optionElement.disabled = true;
                    }
                    departmentSelectElement.appendChild(optionElement);
                }
            }

            function formSubmit() {
                const formWorkRepairSubmit = document.getElementById('edit-work-repair');
                let formData = new FormData(formWorkRepairSubmit);
                const Routing = "{{ route('update.repair') }}";

                formWorkRepairSubmit.onsubmit = function(e) {
                    e.preventDefault();

                    // console.log('123');
                    /* Display the key/value pairs*/
                    for (var pair of formData.entries()) {
                        console.log(pair[0] + ', ' + pair[1]);
                    }
                    // return false;

                    axios.post(Routing, formData).then((res) => {
                        // console.log(res);
                        if (res.status = 200) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: res.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            }
        </script>
    @endsection

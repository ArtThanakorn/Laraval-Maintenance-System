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
                            <option value="ทั้งหมด" selected {{isset($_GET["status"]) && $_GET["status"] == "ทั้งหมด"?'selected' : ''}}>{{ __('ทั้งหมด') }}</option>
                            <option value="ดำเนินการเสร็จสิ้น"{{isset($_GET["status"]) && $_GET["status"] == "ดำเนินการเสร็จสิ้น" ?'selected' : ''}}>{{ __('ดำเนินการเสร็จสิ้น') }}</option>
                            <option value="รอดำเนินการ"{{isset($_GET["status"]) && $_GET["status"] == "รอดำเนินการ"?'selected' : ''}}>{{ __('รอดำเนินการ') }}</option>
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
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($repairs) --}}
                        @foreach ($repairs as $key => $data)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $data['department_name'] }}</td>
                                <td>{{ $data['name'] }}</td>
                                <td>{{ $data['details'] }}</td>
                                <td>{{ $data['site'] }}</td>
                                <td>{{ $data['tag_repair'] }}</td>
                                <td>{{ $data['status_repair'] }}</td>
                                <td>{{ $data['created_at'] }}</td>
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
    {{-- @dd($jChart) --}}
    <div class="row justify-content-center align-items-center g-2 mb-3" style="max-height: 500px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>{{ 'จำนวนงานแยกตามประเภท' }}</p>
                    <canvas id="graphCanvas"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <p>{{ 'จำนวนงานแยกตามประเภทที่ไม่รู้' }}</p>
                <canvas id="graphCanvas2"></canvas>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script type="module">
       let jsData = {!! json_encode($jChart) !!};
        console.log(jsData.datasets1.data.work);

        // เก็บค่า department_name ใน array ใหม่
        const labels = [];
        const Numberofjobs = [];
        for (const item of jsData.datasets1.data) {
            labels.push(item.department_name);
            Numberofjobs.push(item.work);
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
                    position: "right"
                }
            }
        });
//ผลรวมงานทั้งหมด 
let jscompleted = {!! json_encode($ChartWorkcompleted) !!};
let jsnotcompleted = {!! json_encode($ChartWorknotcompleted) !!};
        let myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['งานที่ยังไม่เสร็จ','งานที่เสร็จแล้ว'],
                datasets: [{
                    data:[jsnotcompleted,jscompleted] ,
                    backgroundColor:jsData.datasets2.backgroundColor ,
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
            let url = $url + `/admin/show/repair/` + p + "?status=" + queryParam + "&q="+inpuParam;
            console.log(url);
            window.location.href = url;
        }
    </script>
@endsection

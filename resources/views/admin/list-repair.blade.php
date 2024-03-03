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
<<<<<<< HEAD
    <div class="row justify-content-center align-items-center g-2 mb-3 ">
        <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
=======
    <div class="container">
        <div class="row flex justify-content-center align-items-center g-2 my-3">
            <div class="card" style="width: 75rem; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="" />
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <dic class="col">
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-primary">
                                        รอดำเนินการ
                                    </button>
                                </div>
                            </dic>
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-warning">
                                        อยู่ระหว่างดำเนินการ
                                    </button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-success">
                                        ดำเนินการเส็ดสิ้น
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ประเภทงานซ่อม</th>
                                        <th scope="col">ชื่อผู้แจ้งซ่อม</th>
                                        <th scope="col">รายละเอียดงานซ่อม</th>
                                        <th scope="col">สถานที่</th>
                                        <th scope="col">วันที่แจ้งซ่อม</th>
                                        <th scope="col">สถานะงานเเจ้งซ่อม</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liRepair as $list)
                                        <tr>
                                            <td scope="row">{{ $list->type }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->details }}</td>
                                            <td>{{ $list->site }}</td>
                                            <td>{{ $list->created_at }}</td>
                                            <td style="display:flex; height: 65px; align-items: center; justify-content: center;">

                                                <div
                                                @switch($list->status_repair)
                                                    @case('รอดำเนินการ')
                                                    class="p-2"
                                                    @style(['color:#ffffff', 'background-color:#279fff', 'border-radius:15px','font-size:16px','width:auto',' text-align:center'])
                                                    @break
                                                    @case('อยู่ระหว่างดำเนินการ')
                                                    class="p-2"
                                                    @style(['color:#ffffff', 'background-color:#FDE767', 'border-radius:15px','font-size:16px','width:auto',' text-align:center',''])
                                                    @break
                                                    @case('ดำเนินการเส็ดสิ้น')
                                                    class="p-2"
                                                    @style(['color:#ffffff', 'background-color:#20c997', 'border-radius:15px','font-size:16px','width:auto',' text-align:center'])
                                                    @break
                                                 @endswitch
                                                >
                                                    {{ $list->status_repair }}
                                                </div>
                                            </td>
                                            <td><a name="" id="" class="btn btn-primary" href="{{route('handle.repair')}}"
                                                    role="button">จัดการ</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
>>>>>>> testart
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center g-2 mb-3" style="max-height: 500px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>จำนวนงานแยกตามประเภท</p>
                    <canvas id="graphCanvas"></canvas>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="graphT"></canvas>
                </div>
            </div>
        </div> --}}

    </div>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
@section('script')
    <script type="module">
       
        let jsData = {!! json_encode($data) !!};
        console.log(jsData.datasets.backgroundColor);
        
        // เก็บค่า department_name ใน array ใหม่
        const labels = [];
        for (const item of jsData.labels) {
            labels.push(item.department_name);
        }
        let ctx = document.getElementById('graphCanvas').getContext('2d');

        let myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: Object.values(jsData.datasets.data),
                    backgroundColor: jsData.datasets.backgroundColor,
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
@endsection

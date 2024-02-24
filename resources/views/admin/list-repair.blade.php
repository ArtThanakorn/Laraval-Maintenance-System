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
            <div class="card-body">
                {{ $dataTable->table() }}
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

@extends('layout.master')

@vite('resources\css\followUprepir.css')

@section('content')
    <div class="content1">
        <div class="row justify-content-center align-items-center g-2 w-75 ">
            <input class="form-control text-center" type="search" id="search" onchange="filterRepairs()">
            <p id="demo"></p>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let repairData = {!! $repairsData !!}

        function filterRepairs() {
            const resultRepairs = document.getElementById("search");

            const filterData = repairData.find((word) => word.tag_repair === resultRepairs.value);
               
            console.log(filterData);
            document.getElementById("demo").innerHTML = filterData.status_repair;
            // let repairsfilterData;
        }
    </script>
@endsection

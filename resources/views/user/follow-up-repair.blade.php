@extends('layout.master')

@vite('resources\css\followUprepir.css')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ติดตามสถานะการแจ้งซ่อม</h5>
                        <p class="card-text text-primary">กรอกหมายเลขเเท็ก 13 หลัก [ตัวอย่าง : EF582568151TH]</p>
                            <div class="row justify-content-center align-items-center">
                                 <input type="text" class="form-control w-75" id="search" placeholder="กรองหมายเลขเเท็กเพื่อค้นหา">
                                 <div class="col-auto">
                                        <button class="btn btn-primary" onclick="filterRepairs()">ค้นหา</button>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="row justify-content-center" style="display: none" id="list">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">รายการค้นหา</h5>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 id="departmentName"></h6>
                                </div>
                                <div class="col-sm-4 text-center">

                                    <h5 class="text-success" id="demo"></h5>
                                    <h6 id="nameRepair"></h6>
                                </div>
                                <div class="col-sm-4 text-end">
                                    <h6 class="text-danger"><p id="timeCreatedAt"></p></h6>
                                </div>
                            </div>

                                <div class="col-sm-12">
                                    <div class="container">
                                        <input type="radio" class="profile" id="radio1">
                                        <input type="radio" class="posts" id="radio2">
                                        <input type="radio" class="books"  id="radio3">
                                    <div class="head">
                                        <ul class="nav">
                                            <li class="st st1 active">
                                                <h2 class="inner">เเจ้งซ่อม</h2>
                                            </li>
                                            <li class="st st2">
                                                <h2 class="inner">รอดำเนินการ</h2>
                                            </li>
                                            <li class="st st3">
                                                <h2 class="inner">เสร็จสิ้น</h2>
                                            </li>
                                        </ul>
                                        <div class="line">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('script')
    <script>
        let repairData = {!! $repairsData !!}
// cont
        function filterRepairs() {
            const resultRepairs = document.getElementById("search");

            const filterData = repairData.find((word) => word.tag_repair === resultRepairs.value);
            document.getElementById("list").style.display='block';
            if(filterData.status_repair == "รอดำเนินการ"){
                document.getElementById("radio2").checked = true;
            }

            const dateObject = new Date(filterData.created_at);

            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            const formattedDate = dateObject.toLocaleDateString('th-TH', options);

            console.log(formattedDate);


            console.log(filterData);
            document.getElementById("demo").innerHTML ="สถานะ : "+ filterData.status_repair;
            document.getElementById("timeCreatedAt").innerHTML = "วันที่ : "+formattedDate;
            document.getElementById("departmentName").innerHTML = "แผนกที่รับเเจ้ง : "+filterData.department.department_name;
            document.getElementById("nameRepair").innerHTML ="ชื่อผู้เเจ้งซ่อม : "+ filterData.name;
            // let repairsfilterData;
        }
    </script>
@endsection

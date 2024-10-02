@extends('layout.master')

@vite('public\css\followUprepir.css')

@section('content')
    {{--  <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">ติดตามสถานะการแจ้งซ่อม</h5>
                        <p class="card-text text-center text-primary">กรอกหมายเลขเเท็ก 5 หลัก [ตัวอย่าง : 6c335] เพื่อค้นหา</p>
                        <div class="row justify-content-center align-items-center mt-3">
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

        <div class="row justify-content-center pt-5" style="display: none" id="list">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 ">
                                <h5 class="text-primary">รายการค้นหา</h5>
                                <h6 id="departmentName"></h6>
                            </div>
                            <div class="col-sm-4 text-center">
                                <h5 class="text-success" id="demo"></h5>
                                <h6 id="nameRepair"></h6>
                            </div>
                            <div class="col-sm-4 text-end">
                                <h6 class="text-primary">
                                    <p id="timeCreatedAt"></p>
                                </h6>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="container">
                                <input type="radio" class="profile" id="radio1">
                                <input type="radio" class="posts" id="radio2">
                                <input type="radio" class="books" id="radio3">
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
    </div>  --}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <p class="card-text text-center text-primary">กรอกหมายเลขเเท็ก 5 หลัก [ตัวอย่าง : 6c335] เพื่อค้นหา</p>
                <div class="row justify-content-center align-items-center mt-3">
                    <input type="text" class="form-control w-75" id="search" placeholder="กรองหมายเลขเเท็กเพื่อค้นหา">
                    <div class="col-auto">
                        <button class="btn btn-outline-success" onclick="filterRepairs()"><i class='bx bx-search'
                                style="font-size: 25px"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  <div class="col-sm-12" style="display: none" id="list">
        <div class="row">
            <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li id="status1" class="step-wizard-item ">
                        <span class="progress-count">1</span>
                        <span class="progress-label">เเจ้งซ่อม</span>
                    </li>
                    <li id="status2" class="step-wizard-item ">
                        <span class="progress-count ">2</span>
                        <span class="progress-label">รอดำเนินการ</span>
                    </li>
                    <li id="status3"class="step-wizard-item">
                        <span class="progress-count">3</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                </ul>
            </section>
        </div>

        <div class="container text-center col-sm-12">
            <div class="row">
              <div class="col-lg">
                <h6 id="departmentName"></h6>
              </div>
              <div class="col-lg">
                <h5 class="text-success" id="demo"></h5>
                <h6 id="nameRepair"></h6>
              </div>
              <div class="col-lg">
                <p id="timeCreatedAt"></p>
              </div>
            </div>
        </div>
    </div>  --}}

    <div class="col-sm-12" style="display: none" id="list">
        <div class="row">
            <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li id="status1" class="step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">เเจ้งซ่อม</span>
                    </li>
                    <li id="status2" class="step-wizard-item">
                        <span class="progress-count ">2</span>
                        <span class="progress-label">รอดำเนินการ</span>
                    </li>
                    <li id="status3" class="step-wizard-item">
                        <span class="progress-count">3</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                </ul>
            </section>
        </div>

        <div class="container text-center col-sm-12">
            <div class="row d-flex align-items-center">
                <div class="col-lg">
                    <h6 id="departmentName"></h6>
                </div>
                <div class="col-lg">
                    <h5 class="text-success" id="demo"></h5>
                    <h6 id="nameRepair"></h6>
                </div>
                <div class="col-lg">
                    <p id="timeCreatedAt"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
            let repairData = {!! $repairsData !!}
            console.log(repairData);

            function filterRepairs() {
                let status1 = document.getElementById("status1");
                let status2 = document.getElementById("status2");
                let status3 = document.getElementById("status3");
                const resultRepairs = document.getElementById("search");
                const filterData = repairData.find((word) => word.tag_repair === resultRepairs.value);

                // console.log(filterData);
                if (filterData) {
                    const dateObject = new Date(filterData.updated_at);
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    const formattedDate = dateObject.toLocaleDateString('th-TH', options);
                    document.getElementById("list").style.display = 'block';
                    if (filterData.status_repair == "รอดำเนินการ") {
                        console.log("123");
                        status2.classList.add("current-item");
                        status1.classList.remove("current-item");
                        status3.classList.remove("current-item");
                        /* document.getElementById("radio2").checked = true;
                        document.getElementById("radio3").checked = false;*/
                        document.getElementById("demo").innerHTML = "สถานะ : " + filterData.status_repair;
                        document.getElementById("timeCreatedAt").innerHTML = "วันที่ : " + formattedDate;
                        document.getElementById("departmentName").innerHTML = "เเจ้งซ่อมไปแผนก : " + filterData.department.department_name;
                        document.getElementById("nameRepair").innerHTML = "ชื่อผู้เเจ้งซ่อม : " + filterData.name;
                    } else if (filterData.status_repair == "ดำเนินการเสร็จสิ้น") {
                        /*document.getElementById("radio3").checked = true;*/
                        status3.classList.add("current-item");
                        status1.classList.remove("current-item");
                        status2.classList.remove("current-item");

                    // document.getElementById("demo").innerHTML = "สถานะ : " + filterData.status_repair;
                    // document.getElementById("timeCreatedAt").innerHTML = "วันที่ : " + formattedDate;
                    // document.getElementById("departmentName").innerHTML = "แผนกที่รับเเจ้ง : " + filterData.department
                    //     .department_name;
                    // document.getElementById("nameRepair").innerHTML = "ชื่อผู้เเจ้งซ่อม : " + filterData.name;
                }
                // let repairsfilterData;
            }
    </script>
@endsection

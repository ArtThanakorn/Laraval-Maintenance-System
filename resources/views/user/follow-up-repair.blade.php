@extends('layout.master')

@vite('resources\css\followUprepir.css')

@section('content')

    {{--  <div class="card mb-3" style="max-width: 800px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScJ7Enh0Zg8jVlRleiXNeettNBiVhGDGe5BA&usqp=CAU"
             class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">ติดตามสถานะการแจ้งซ่อม</h5>
              <p class="card-text">กรอกหมายเลขเเท็ก 13 หลัก [ตัวอย่าง : EF582568151TH]</p>
              <div class="row">
                <div class="search">
                    <input type="text" class="form-control" placeholder="*กรุณาระบบหมายเลขเเท็กเพื่อค้นหา">
                    <button class="btn btn-primary">ค้นหา</button>
                </div>
              </div>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
    </div>  --}}

    {{--  <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <h5 class="card-title">ติดตามสถานะการแจ้งซ่อม</h5>
                        <span class="text text-primary">กรอกหมายเลขเเท็ก 13 หลัก [ตัวอย่าง : EF582568151TH]</span>

                            <div class="input-group mb-6">
                                <input type="text" class="form-control me-2" id="search" placeholder="กรุณากรองหมายเลขเเท็กเเจ้งซ่อมเพื่อค้นหา">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" onclick="filterRepairs()">ค้นหา</button>
                                    </div>
                                </input>
                            </div>

                    <p id="demo"></p>
                </div>
            </div>
        </div>
    </div>  --}}

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

                {{--  <p id="demo"></p>  --}}
            </div>
        </div>
        <br>

        <div class="row justify-content-center">
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
                            <div class="row text-center">
                                <div class="col-sm-12">
                                    <h6>351348646435453</h6>
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
cont
        function filterRepairs() {
            const resultRepairs = document.getElementById("search");

            const filterData = repairData.find((word) => word.tag_repair === resultRepairs.value);

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

@extends('layout.master')

{{-- @vite('public\css\followUprepir.css') --}}
@section('style')
    <link href="/css/followUprepir.css" rel="stylesheet" />
@endsection
@section('content')
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
                        <span class="progress-count ">3</span>
                        <span class="progress-label">กำลังดำเนินการ</span>
                    </li>
                    <li id="status4" class="step-wizard-item">
                        <span class="progress-count ">4</span>
                        <span class="progress-label">รออะไหล่</span>
                    </li>
                    <li id="status5" class="step-wizard-item">
                        <span class="progress-count">5</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                </ul>
            </section>
        </div>
        <div class="container text-center col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">{{ 'สถานะ' }}</th>
                            <th scope="col">{{ 'วันที่' }}</th>
                            <th scope="col">{{ 'แผนกที่รับเเจ้ง' }}</th>
                            <th scope="col">{{ 'ชื่อผู้เเจ้งซ่อม' }}</th>
                        </tr>
                    </thead>
                    <tbody id="table-details">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        let repairData = {!! $repairsData !!}
        // console.log(repairData);

        function filterRepairs() {
            let status1 = document.getElementById("status1");
            let status2 = document.getElementById("status2");
            let status3 = document.getElementById("status3");
            let status4 = document.getElementById("status4");
            let status5 = document.getElementById("status5");
            const resultRepairs = document.getElementById("search");
            const filterData = repairData.find((word) => word.tag_repair === resultRepairs.value);

            console.log(filterData);
            if (filterData) {
                const dateObject = new Date(filterData.updated_at);

                const formattedDate = dateObject;
                document.getElementById("list").style.display = 'block';
                if (filterData.status_repair == "เเจ้งซ่อม") {
                    status1.classList.add("current-item");
                    status2.classList.remove("current-item");
                    status3.classList.remove("current-item");
                    status4.classList.remove("current-item");
                    status5.classList.remove("current-item");
                    /* document.getElementById("radio2").checked = true;
                    document.getElementById("radio3").checked = false;*/

                } else if (filterData.status_repair == "รอดำเนินการ") {
                    /*document.getElementById("radio3").checked = true;*/
                    status1.classList.remove("current-item");
                    status2.classList.add("current-item");
                    status3.classList.remove("current-item");
                    status4.classList.remove("current-item");
                    status5.classList.remove("current-item");
                } else if (filterData.status_repair == "กำลังดำเนินการ") {
                    /*document.getElementById("radio3").checked = true;*/
                    status1.classList.remove("current-item");
                    status2.classList.remove("current-item");
                    status3.classList.add("current-item");
                    status4.classList.remove("current-item");
                    status5.classList.remove("current-item");
                } else if (filterData.status_repair == "รออะไหล่") {
                    /*document.getElementById("radio3").checked = true;*/
                    status1.classList.remove("current-item");
                    status2.classList.remove("current-item");
                    status3.classList.remove("current-item");
                    status4.classList.add("current-item");
                    status5.classList.remove("current-item");
                } else if (filterData.status_repair == "ดำเนินการเสร็จสิ้น") {
                    /*document.getElementById("radio3").checked = true;*/
                    status1.classList.remove("current-item");
                    status2.classList.remove("current-item");
                    status3.classList.remove("current-item");
                    status4.classList.remove("current-item");
                    status5.classList.add("current-item");
                }
                // let repairsfilterData;
            } else {
                Swal.fire({
                    title: "ผิดพลาด",
                    text: "ไม่พบเลขเเท็กของคุณ",
                    icon: "warning"
                });
            }
            document.getElementById('table-details').innerHTML =
                `
            <tr>
                 ${filterData.follow[0]?(`
                    <td scope="row">${filterData.follow[0].status_repair}</td>
                    <td>${filterData.follow[0].created_at}</td>
                    <td>${filterData.department.department_name}</td>
                    <td>${filterData.name}</td>
                    `):''}
            </tr>
            <tr>
                 ${filterData.follow[1]?(`
                    <td scope="row">${filterData.follow[1].status_repair}</td>
                    <td>${filterData.follow[1].created_at}</td>
                    <td>${filterData.department.department_name}</td>
                    <td>${filterData.name}</td>
                    `):''}
            </tr>
            <tr>
                 ${filterData.follow[2]?(`
                    <td scope="row">${filterData.follow[2].status_repair}</td>
                    <td>${filterData.follow[2].created_at}</td>
                    <td>${filterData.department.department_name}</td>
                    <td>${filterData.name}</td>
                    `):''}
            </tr>
            <tr>
                 ${filterData.follow[3]?(`
                    <td scope="row">${filterData.follow[3].status_repair}</td>
                    <td>${filterData.follow[3].created_at}</td>
                    <td>${filterData.department.department_name}</td>
                    <td>${filterData.name}</td>
                `):''}
            </tr>
            <tr>
                ${filterData.follow[4]?(`
                        <td scope="row">${filterData.follow[4].status_repair}</td>
                    <td>${filterData.follow[4].created_at}</td>
                    <td>${filterData.department.department_name}</td>
                    <td>${filterData.name}</td>
                    `):''}
            </tr>       
            `
        }
    </script>
@endsection

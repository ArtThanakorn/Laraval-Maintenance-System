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
                    <button class="btn btn-outline-success" id="find"><i class='bx bx-search'
                            style="font-size: 25px"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12" style="display: none" id="list">
        <div class="row">
            <section class="step-wizard">
                <ul id="step-repairs" class="step-wizard-list" >
                   
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
                            <th scope="col">{{ 'ชื่อผู้แจ้งซ่อม' }}</th>
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
        let tegRepair = '{{ $inputTeg }}';

        const buttonRepair = document.getElementById("find");

        buttonRepair.addEventListener("click", function() {
            console.log('1');
            
            filterRepairs();
        });

        if (tegRepair != null) {
            console.log('2');

            filterRepairs();
        }

        function filterRepairs() {
           
            const resultRepairs = document.getElementById("search");
            
            console.log(tegRepair);
            let filterData = new Object();
            if (tegRepair != '') {
                filterData = repairData.find((word) => word.tag_repair === tegRepair);
            }else{
                console.log(resultRepairs.value);
                
                 filterData = repairData.find((word) => word.tag_repair == resultRepairs.value);
            }

            console.log(filterData);
            if (filterData) {
                const dateObject = new Date(filterData.updated_at);

                const formattedDate = dateObject;
                document.getElementById("list").style.display = 'block';
                if (filterData.status_repair == "แจ้งซ่อม") {
                    document.getElementById('step-repairs').innerHTML =`
                     <li class="step-wizard-item current-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">แจ้งซ่อม</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count ">2</span>
                        <span class="progress-label">รอดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count ">3</span>
                        <span class="progress-label">กำลังดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count">5</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                    `;
                    

                } else if (filterData.status_repair == "รอดำเนินการ") {
                    document.getElementById('step-repairs').innerHTML =`
                     <li class="step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">แจ้งซ่อม</span>
                    </li>
                    <li class="step-wizard-item current-item">
                        <span class="progress-count ">2</span>
                        <span class="progress-label">รอดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count ">3</span>
                        <span class="progress-label">กำลังดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count">5</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                    `;
                } else if (filterData.status_repair == "กำลังดำเนินการ") {
                    document.getElementById('step-repairs').innerHTML =`
                     <li class="step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">แจ้งซ่อม</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count ">2</span>
                        <span class="progress-label">รอดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item current-item">
                        <span class="progress-count ">3</span>
                        <span class="progress-label">กำลังดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count">5</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                    `;
                } else if (filterData.status_repair == "รออะไหล่") {
                    document.getElementById('step-repairs').innerHTML =`
                     <li class="step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">แจ้งซ่อม</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count ">2</span>
                        <span class="progress-label">รอดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item current-item">
                        <span class="progress-count ">3</span>
                        <span class="progress-label">รออะไหล่</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count">5</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                    `;
                } else if (filterData.status_repair == "ดำเนินการเสร็จสิ้น") {
                    document.getElementById('step-repairs').innerHTML =`
                     <li class="step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">แจ้งซ่อม</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count ">2</span>
                        <span class="progress-label">รอดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item ">
                        <span class="progress-count ">3</span>
                        <span class="progress-label">กำลังดำเนินการ</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count">5</span>
                        <span class="progress-label">เสร็จสิ้น</span>
                    </li>
                    `;
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
                 ${filterData.follow[0] != null?(`
                                <td scope="row">${filterData.follow[0].status_repair}</td>
                                <td>${filterData.follow[0].created_at}</td>
                                <td>${filterData.department == null?'-':filterData.department.department_name}</td>
                                <td>${filterData.name}</td>
                                `):''}
            </tr>
            <tr>
                 ${filterData.follow[1]?(`
                                <td scope="row">${filterData.follow[1].status_repair}</td>
                                <td>${filterData.follow[1].created_at}</td>
                                <td>${filterData.department == null?'-':filterData.department.department_name}</td>
                                <td>${filterData.name}</td>
                                `):''}
            </tr>
            <tr>
                 ${filterData.follow[2]?(`
                                <td scope="row">${filterData.follow[2].status_repair}</td>
                                <td>${filterData.follow[2].created_at}</td>
                                <td>${filterData.department == null?'-':filterData.department.department_name}</td>
                                <td>${filterData.name}</td>
                                `):''}
            </tr>
            <tr>
                 ${filterData.follow[3]?(`
                                <td scope="row">${filterData.follow[3].status_repair}</td>
                                <td>${filterData.follow[3].created_at}</td>
                                <td>${filterData.department == null?'-':filterData.department.department_name}</td>
                                <td>${filterData.name}</td>
                            `):''}
            </tr>
            <tr>
                ${filterData.follow[4]?(`
                                    <td scope="row">${filterData.follow[4].status_repair}</td>
                                <td>${filterData.follow[4].created_at}</td>
                                <td>${filterData.department == null?'-':filterData.department.department_name}</td>
                                <td>${filterData.name}</td>
                                `):''}
            </tr>       
            `
        }
    </script>
@endsection

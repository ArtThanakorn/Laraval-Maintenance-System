@extends('layout.master')

@section('content')
<script>
    .wrapper {
        margin-top: 5vh;
      }

      .dataTables_filter {
        float: right;
      }

      .table-hover > tbody > tr:hover {
        background-color: #ccffff;
      }

      @media only screen and (min-width: 768px) {
        .table {
          table-layout: fixed;
          max-width: 100% !important;
        }
      }

      thead {
        background: #ddd;
      }

      .table td:nth-child(2) {
        overflow: hidden;
        text-overflow: ellipsis;
      }

      .highlight {
        background: #ffff99;
      }

      @media only screen and (max-width: 767px) {
        /* Force table to not be like tables anymore */
        table,
      thead,
      tbody,
      th,
      td,
      tr {
          display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr,
      tfoot tr {
          position: absolute;
          top: -9999px;
          left: -9999px;
        }

        td {
          /* Behave  like a "row" */
          border: none;
          border-bottom: 1px solid #eee;
          position: relative;
          padding-left: 50% !important;
        }

        td:before {
          /* Now like a table header */
          position: absolute;
          /* Top/left values mimic padding */
          top: 6px;
          left: 6px;
          width: 45%;
          padding-right: 10px;
          white-space: nowrap;
        }

        .table td:nth-child(1) {
          background: #ccc;
          height: 100%;
          top: 0;
          left: 0;
          font-weight: bold;
        }

        /*
        Label the data
        */
        td:nth-of-type(1):before {
          content: "Name";
        }

        td:nth-of-type(2):before {
          content: "Position";
        }

        td:nth-of-type(3):before {
          content: "Office";
        }

        td:nth-of-type(4):before {
          content: "Age";
        }

        td:nth-of-type(5):before {
          content: "Start date";
        }

        td:nth-of-type(6):before {
          content: "Salary";
        }

        .dataTables_length {
          display: none;
        }
      }
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
          //disable sorting on last column
          "columnDefs": [
            { "orderable": false, "targets": 5 }
          ],
          language: {
            //customize pagination prev and next buttons: use arrows instead of words
            'paginate': {
              'previous': '<span class="fa fa-chevron-left"></span>',
              'next': '<span class="fa fa-chevron-right"></span>'
            },
            //customize number of elements to be displayed
            "lengthMenu": 'Display <select class="form-control input-sm">'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            '<option value="-1">All</option>'+
            '</select> results'
          }
        })
    } );
</script>
{{--  เริ่มการ์ดด้านบน  --}}
        <div class="container my-3">
            <div class="row ">
                <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-tasks fa-2x text-info" aria-hidden="true"></i>
                        <div class="ms-3 text-center">
                        <p class="text-muted mb-0">กำลังดำเนินการ</p>
                        <p class="fw-bold mb-1">3</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-wrench fa-2x text-warning" aria-hidden="true"></i>
                        <div class="ms-3 text-center">
                        <p class="text-muted mb-0">กำลังซ่อม</p>
                        <p class="fw-bold mb-1">5</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                        <div class="ms-3 text-center">
                        <p class="text-muted mb-0">ซ่อมเสร็จเเล้ว</p>
                        <p class="fw-bold mb-1">7</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
            {{--  จบการ์ด ด้านบน  --}}

            {{--  เริ่มตาราง  --}}
                <div class="container-fluid px-4 my-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            รายชื่อผู้ปฎิบัติงาน
                        </div>

                        <div class="card-body">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่องาน</th>
                                        <th>รายละเอียดผู้เเจ้ง</th>
                                        <th>รายละเอียดงาน</th>
                                        <th>สถาณที่</th>
                                        <th>สถานะ</th>
                                        <th>วันที่มอบหมายงาน</th>
                                        <th>รับงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>ท่อเเตก</td>
                                        <td>นายสาวสายฝน</td>
                                        <td>ถอยรถเยียบท่อเเตก</td>
                                        <td>อาคาร 18 ที่จอดรถติดสนามบอล</td>
                                        <td>กำลังดำเนินการ</td>
                                        <td>15-03-2023,19:43</td>
                                        <td><button type="button" class="btn btn-success btn-sm">รับงาน</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>หลอดไฟดับ</td>
                                        <td>นายสาวสายฝน</td>
                                        <td>ใช้งานอยู่ดีๆเเล้วดับไป</td>
                                        <td>อาคาร 18 ชั้น 1 ห้องน้ำ</td>
                                        <td>กำลังซ่อม</td>
                                        <td>15/03/2023,19:43</td>
                                        <td><button type="button" class="btn btn-success btn-sm">รับงาน</button></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>หญ้าลก</td>
                                        <td>นายสาวสายฝน</td>
                                        <td>ฝนตกหลายวันหญ้าเลยขึ้นเยอะ</td>
                                        <td>รอบๆ สนามฟูตบอล</td>
                                        <td>ซ่อมเสร็จเเล้ว</td>
                                        <td>15-03-2023,19:43</td>
                                        <td><button type="button" class="btn btn-success btn-sm">รับงาน</button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่องาน</th>
                                        <th>รายละเอียดผู้เเจ้ง</th>
                                        <th>รายละเอียดงาน</th>
                                        <th>สถาณที่</th>
                                        <th>สถานะ</th>
                                        <th>วันที่มอบหมายงาน</th>
                                        <th>รับงาน</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
@endsection

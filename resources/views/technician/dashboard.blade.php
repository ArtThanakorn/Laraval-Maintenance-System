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
{{--  <script>
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

</script>  --}}

        {{--  เริ่มตาราง  --}}

        {{--  <div class="container">
            <h3 class="mt-4">ตารางข้อมูลรายการเเจ้งซ่อม</h3>

            <hr>
            <div class="card text-center">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#">รายการเเจ้งซ่อมทั้งหมด</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">กำลังดำเนินการ</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">ซ่อมเสร็จเเล้ว</a>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011-04-25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011-07-25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009-01-12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012-03-29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008-11-28</td>
                            <td>$162,700</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012-12-02</td>
                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012-08-06</td>
                            <td>$137,500</td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2010-10-14</td>
                            <td>$327,900</td>
                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2009-09-15</td>
                            <td>$205,500</td>
                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>
                            <td>23</td>
                            <td>2008-12-13</td>
                            <td>$103,600</td>
                        </tr>
                        <tr>
                            <td>Jena Gaines</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>30</td>
                            <td>2008-12-19</td>
                            <td>$90,560</td>
                        </tr>
                        <tr>
                            <td>Quinn Flynn</td>
                            <td>Support Lead</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2013-03-03</td>
                            <td>$342,000</td>
                        </tr>
                        <tr>
                            <td>Charde Marshall</td>
                            <td>Regional Director</td>
                            <td>San Francisco</td>
                            <td>36</td>
                            <td>2008-10-16</td>
                            <td>$470,600</td>
                        </tr>
                        <tr>
                            <td>Haley Kennedy</td>
                            <td>Senior Marketing Designer</td>
                            <td>London</td>
                            <td>43</td>
                            <td>2012-12-18</td>
                            <td>$313,500</td>
                        </tr>
                        <tr>
                            <td>Tatyana Fitzpatrick</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>19</td>
                            <td>2010-03-17</td>
                            <td>$385,750</td>
                        </tr>
                        <tr>
                            <td>Michael Silva</td>
                            <td>Marketing Designer</td>
                            <td>London</td>
                            <td>66</td>
                            <td>2012-11-27</td>
                            <td>$198,500</td>
                        </tr>
                        <tr>
                            <td>Paul Byrd</td>
                            <td>Chief Financial Officer (CFO)</td>
                            <td>New York</td>
                            <td>64</td>
                            <td>2010-06-09</td>
                            <td>$725,000</td>
                        </tr>
                        <tr>
                            <td>Gloria Little</td>
                            <td>Systems Administrator</td>
                            <td>New York</td>
                            <td>59</td>
                            <td>2009-04-10</td>
                            <td>$237,500</td>
                        </tr>
                        <tr>
                            <td>Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>
                            <td>2012-10-13</td>
                            <td>$132,000</td>
                        </tr>
                        <tr>
                            <td>Dai Rios</td>
                            <td>Personnel Lead</td>
                            <td>Edinburgh</td>
                            <td>35</td>
                            <td>2012-09-26</td>
                            <td>$217,500</td>
                        </tr>
                        <tr>
                            <td>Jenette Caldwell</td>
                            <td>Development Lead</td>
                            <td>New York</td>
                            <td>30</td>
                            <td>2011-09-03</td>
                            <td>$345,000</td>
                        </tr>
                        <tr>
                            <td>Yuri Berry</td>
                            <td>Chief Marketing Officer (CMO)</td>
                            <td>New York</td>
                            <td>40</td>
                            <td>2009-06-25</td>
                            <td>$675,000</td>
                        </tr>
                        <tr>
                            <td>Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2011-12-12</td>
                            <td>$106,450</td>
                        </tr>
                        <tr>
                            <td>Doris Wilder</td>
                            <td>Sales Assistant</td>
                            <td>Sydney</td>
                            <td>23</td>
                            <td>2010-09-20</td>
                            <td>$85,600</td>
                        </tr>
                        <tr>
                            <td>Angelica Ramos</td>
                            <td>Chief Executive Officer (CEO)</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2009-10-09</td>
                            <td>$1,200,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Joyce</td>
                            <td>Developer</td>
                            <td>Edinburgh</td>
                            <td>42</td>
                            <td>2010-12-22</td>
                            <td>$92,575</td>
                        </tr>
                        <tr>
                            <td>Jennifer Chang</td>
                            <td>Regional Director</td>
                            <td>Singapore</td>
                            <td>28</td>
                            <td>2010-11-14</td>
                            <td>$357,650</td>
                        </tr>
                        <tr>
                            <td>Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2011-06-07</td>
                            <td>$206,850</td>
                        </tr>
                        <tr>
                            <td>Fiona Green</td>
                            <td>Chief Operating Officer (COO)</td>
                            <td>San Francisco</td>
                            <td>48</td>
                            <td>2010-03-11</td>
                            <td>$850,000</td>
                        </tr>
                        <tr>
                            <td>Shou Itou</td>
                            <td>Regional Marketing</td>
                            <td>Tokyo</td>
                            <td>20</td>
                            <td>2011-08-14</td>
                            <td>$163,000</td>
                        </tr>
                        <tr>
                            <td>Michelle House</td>
                            <td>Integration Specialist</td>
                            <td>Sydney</td>
                            <td>37</td>
                            <td>2011-06-02</td>
                            <td>$95,400</td>
                        </tr>
                        <tr>
                            <td>Suki Burks</td>
                            <td>Developer</td>
                            <td>London</td>
                            <td>53</td>
                            <td>2009-10-22</td>
                            <td>$114,500</td>
                        </tr>
                        <tr>
                            <td>Prescott Bartlett</td>
                            <td>Technical Author</td>
                            <td>London</td>
                            <td>27</td>
                            <td>2011-05-07</td>
                            <td>$145,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Cortez</td>
                            <td>Team Leader</td>
                            <td>San Francisco</td>
                            <td>22</td>
                            <td>2008-10-26</td>
                            <td>$235,500</td>
                        </tr>
                        <tr>
                            <td>Martena Mccray</td>
                            <td>Post-Sales support</td>
                            <td>Edinburgh</td>
                            <td>46</td>
                            <td>2011-03-09</td>
                            <td>$324,050</td>
                        </tr>
                        <tr>
                            <td>Unity Butler</td>
                            <td>Marketing Designer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009-12-09</td>
                            <td>$85,675</td>
                        </tr>
                        <tr>
                            <td>Howard Hatfield</td>
                            <td>Office Manager</td>
                            <td>San Francisco</td>
                            <td>51</td>
                            <td>2008-12-16</td>
                            <td>$164,500</td>
                        </tr>
                        <tr>
                            <td>Hope Fuentes</td>
                            <td>Secretary</td>
                            <td>San Francisco</td>
                            <td>41</td>
                            <td>2010-02-12</td>
                            <td>$109,850</td>
                        </tr>
                        <tr>
                            <td>Vivian Harrell</td>
                            <td>Financial Controller</td>
                            <td>San Francisco</td>
                            <td>62</td>
                            <td>2009-02-14</td>
                            <td>$452,500</td>
                        </tr>
                        <tr>
                            <td>Timothy Mooney</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>37</td>
                            <td>2008-12-11</td>
                            <td>$136,200</td>
                        </tr>
                        <tr>
                            <td>Jackson Bradshaw</td>
                            <td>Director</td>
                            <td>New York</td>
                            <td>65</td>
                            <td>2008-09-26</td>
                            <td>$645,750</td>
                        </tr>
                        <tr>
                            <td>Olivia Liang</td>
                            <td>Support Engineer</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2011-02-03</td>
                            <td>$234,500</td>
                        </tr>
                        <tr>
                            <td>Bruno Nash</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>
                            <td>2011-05-03</td>
                            <td>$163,500</td>
                        </tr>
                        <tr>
                            <td>Sakura Yamamoto</td>
                            <td>Support Engineer</td>
                            <td>Tokyo</td>
                            <td>37</td>
                            <td>2009-08-19</td>
                            <td>$139,575</td>
                        </tr>
                        <tr>
                            <td>Thor Walton</td>
                            <td>Developer</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2013-08-11</td>
                            <td>$98,540</td>
                        </tr>
                        <tr>
                            <td>Finn Camacho</td>
                            <td>Support Engineer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009-07-07</td>
                            <td>$87,500</td>
                        </tr>
                        <tr>
                            <td>Serge Baldwin</td>
                            <td>Data Coordinator</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2012-04-09</td>
                            <td>$138,575</td>
                        </tr>
                        <tr>
                            <td>Zenaida Frank</td>
                            <td>Software Engineer</td>
                            <td>New York</td>
                            <td>63</td>
                            <td>2010-01-04</td>
                            <td>$125,250</td>
                        </tr>
                        <tr>
                            <td>Zorita Serrano</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>56</td>
                            <td>2012-06-01</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Jennifer Acosta</td>
                            <td>Junior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>43</td>
                            <td>2013-02-01</td>
                            <td>$75,650</td>
                        </tr>
                        <tr>
                            <td>Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2011-12-06</td>
                            <td>$145,600</td>
                        </tr>
                        <tr>
                            <td>Hermione Butler</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2011-03-21</td>
                            <td>$356,250</td>
                        </tr>
                        <tr>
                            <td>Lael Greer</td>
                            <td>Systems Administrator</td>
                            <td>London</td>
                            <td>21</td>
                            <td>2009-02-27</td>
                            <td>$103,500</td>
                        </tr>
                        <tr>
                            <td>Jonas Alexander</td>
                            <td>Developer</td>
                            <td>San Francisco</td>
                            <td>30</td>
                            <td>2010-07-14</td>
                            <td>$86,500</td>
                        </tr>
                        <tr>
                            <td>Shad Decker</td>
                            <td>Regional Director</td>
                            <td>Edinburgh</td>
                            <td>51</td>
                            <td>2008-11-13</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Michael Bruce</td>
                            <td>Javascript Developer</td>
                            <td>Singapore</td>
                            <td>29</td>
                            <td>2011-06-27</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2011-01-25</td>
                            <td>$112,000</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
                <table id="example" class="table-hover">
                    <thead>
                        <th>ID</th>
                        <th>ชื่องาน</th>
                        <th>รายละเอียดผู้เเจ้ง</th>
                        <th>รายละเอียดงาน</th>
                        <th>สถานที่</th>
                        <th>สถานะ</th>
                        <th>วันที่มอบงาน</th>
                        <th>รับงาน</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>ไฟเสีย</td>
                            <td>นาย หนึ่ง</td>
                            <td>หลอดไฟเปิดไม่คิด</td>
                            <td>อาคาร 18 ชั้น 2</td>
                            <td>กำลังดำเนินการ</td>
                            <td>15-03-2023,1945.21</td>
                            <td><button class="btn btn-success btn-sm">รับงาน</button></td>
                        </tr>
                    </tbody>
                </table>

        </div>   --}}

        {{--  จบตาราง  --}}
    {{--  เริ่มการ์ดด้านบน  --}}
    {{-- <div class="container my-3">
            <div class="row ">
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-tasks fa-3x text-info"></i>
                                <div class="text-end text-secondary">
                                    <h5>ดูรายการเเจ้งซ่อม</h5>
                                    <h3>12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href=""></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-wrench fa-3x text-warning"></i>
                                <div class="text-end text-secondary">
                                    <h5>จัดการงานเเจ้งซ่อม</h5>
                                    <h3>12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href=""></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-check-circle fa-3x text-success"></i>
                                <div class="text-end text-secondary">
                                    <h5>ซ่อมเสร็จเเล้ว</h5>
                                    <h3>12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <a class="small text-white stretched-link" href=""></a>
                            <i class="fa fa-arrow-circle-right mr-3"></i>
                            <span>ข้อมูลเพิ่มเติม</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    {{--  จบการ์ด ด้านบน  --}}

    {{--  เริ่มตาราง  --}}
    <div class="container">
        <h3 class="mt-4">ตารางข้อมูลรายการเเจ้งซ่อม</h3>
        <div class="row justify-content-center align-items-center g-2 mb-3">
            <div class="card">
                <div class="row justify-content-between align-items-center g-2 mt-2 ">

                    <div class="d-flex justify-content-center mb-3">
                        <div class="p-2">
                            <div class="flex" style="width: 2.5cm; margin-left: 14px;">
                                <select id="per-page" class="form-select" aria-label="Default select example"
                                    onchange="entries()">

                                    <option value="10" {{ $p == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25"{{ $p == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50"{{ $p == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100"{{ $p == 100 ? 'selected' : '' }}>100</option>
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
                                    <option selected disabled>{{ 'สถานะงานเเจ้งซ่อม' }}</option>
                                    <option value="เนินการเสร็จสิ้น">{{ __('ดำเนินการเสร็จสิ้น') }}</option>
                                    <option value="รอดำเนินการ">{{ __('รอดำเนินการ') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-2">

                            <div class="col-auto">
                                <form action="{{ route('technician.dashboard', ['p' => 10], request()->query()) }}">
                                    <div class="flex">
                                        <input type="text" name="q" placeholder="Search"
                                            class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none"
                                            value="{{ $search_param }}" />
                                        <button type="submit"
                                            class="w-10 flex items-center justify-center border-t border-r border-b border-gray-200 rounded-r text-gray-100 bg-blue-500">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @dd($users) --}}

                <div class="card-body">
                    <table class="table table-bordered mb-5">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ผู้แจ้งซ่อม</th>
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">สถานที่</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workData as $key => $data)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->details }}</td>
                                    <td>{{ $data->site }}</td>
                                    <td>{{ $data->status_repair }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-mdb-ripple-init
                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                            onclick="openEditModal({{ $key }})">{{ 'แก้ไข' }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {!! $workData->links('layout.pagination-custom') !!}
                    </div>
                    {{--  จบตาราง  --}}
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="form-technician">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">ผู้แจ้งซ่อม</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="editModalName" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">สถานะ</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="editModalStatus" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">สถานที่</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="editModalSite" readonly>
                                            {{-- <input type="text" class="form-control" name="inputName" id="editModalSite"
                                                placeholder="Name" > --}}
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">รายละเอียด</label>
                                        <div class="col-8">
                                            <textarea class="form-control" id="editModalDetails" rows="3" readonly></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-4 col-form-label">ส่งงานไปยัง</label>
                                        <div class="col-8">
                                            <select class="form-select" id="department-select"
                                                aria-label="Default select example" name="newdepartment">
                                                @foreach ($department as $row)
                                                    <option value="{{ $row->department_id }} ">
                                                        {{ $row->department_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="editModalId" name="id">
                                    {{-- <fieldset class="mb-3 row">
                                        <legend class="col-form-legend col-4">
                                            Group name
                                        </legend>
                                        <div class="col-8">
                                            you can use radio and checkboxes here
                                        </div>
                                    </fieldset>
                                    <div class="mb-3 row">
                                        <div class="offset-sm-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">
                                                Action
                                            </button>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="submitForm()"
                                    class="btn btn-primary">{{ 'บันทึก' }}</button>
                                {{-- <button type="submit" class="btn btn-primary">Save changes</button> --}}
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ 'ยกเลิก' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endsection
        @section('script')
            <script>
                function submitForm() {
                    // Get form data
                    let formData = new FormData(document.getElementById('form-technician'));
                    /* Display the key/value pairs*/
                    // for (var pair of formData.entries()) {
                    //     console.log(pair[0] + ', ' + pair[1]);
                    // }
                    // return false;
                    // Determine the URL for the Axios request
                    let url = "{{ route('moveswork') }}";

                    // Send the Axios request
                    axios.post(url, formData)
                        .then(function(response) {
                            // Handle the success response if needed
                            console.log(response.data);
                            Swal.fire({
                                title: "Success!",
                                text: "You clicked the button!",
                                icon: "success"
                            }).then((result) => {
                                location.href = $url+"/technician/dashboard/10";
                            });
                        })
                        .catch(function(error) {
                            // Handle the error response if needed
                            console.error(error);
                        });

                }

                function entries() {
                    let p = document.getElementById('per-page').value;
                    console.log(p);
                    window.location.replace($url + `/technician/dashboard/${p}`);
                    // axios.get($url +`/technician/dashboard/${p}`)
                    //     .then(function(response) {
                    //         location.reload();
                    //     })
                    //     .catch(function(error) {
                    //         console.log(error);
                    //     });
                }

                const department = {!! json_encode($department) !!};

                function openEditModal(index) {
                    // ดึงข้อมูลจากตัวแปร $workData ที่ได้รับมาจาก Laravel
                    var workData = <?php echo json_encode($workData); ?>;

                    // ดึงข้อมูลของแถวที่เลือก
                    var selectedData = workData.data[index];
                    console.log(selectedData);
                    // แสดงข้อมูลใน Modal
                    const modalDataDetails = document.getElementById('editModalDetails').value = selectedData.details;
                    const modalDataSite = document.getElementById('editModalSite').value = selectedData.site;
                    const modalDataStatus = document.getElementById('editModalStatus').value = selectedData.status_repair;
                    const modalDataName = document.getElementById('editModalName').value = selectedData.name;
                    const modalDataId = document.getElementById('editModalId').value = selectedData.id_repair;

                    // Select the 'select' element with ID 'department-select'
                    const departmentSelectElement = document.getElementById('department-select');

                    // const selectElement = document.querySelector('.department-select');

                    departmentSelectElement.innerHTML = '';
                    console.log(department);

                    for (const row of department) {
                        const optionElement = document.createElement('option');
                        optionElement.value = row.department_id;
                        optionElement.textContent = row.department_name;

                        // Set 'selected' attribute based on condition
                        if (row.department_id == selectedData.type) {
                            optionElement.selected = true;
                            optionElement.disabled = true;
                        }

                        departmentSelectElement.appendChild(optionElement);
                    }
                }

                function statusRepair() {
                    let s = document.getElementById('status-repair').value;
                    console.log(s);
                    let p = document.getElementById('per-page').value;
                    let queryParam = encodeURIComponent(s); // แปลงค่า s เป็นรูปแบบที่เหมาะสำหรับ query parameter
                    let url = "{{ url('technician/dashboard') }}/" + p + "?status=" + queryParam;
                    window.location.href = url;
                }
            </script>
        @endsection

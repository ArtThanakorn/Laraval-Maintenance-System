@extends('layout.master')

@vite('resources\css\followUprepir.css')

@section('content')
    {{--  <div class="content1">
        <div class="row justify-content-center align-items-center g-2 w-75">
            <div class="card justify-content-center align-items-center  text-start">
                <div class="card-body">
                    <h4 class="card-title">Titles</h4>
                    <p class="card-text">Body</p>
                </div>
            </div>
        </div>
    </div>  --}}
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

    <div class="container d-flex justify-content-center">
        <div class="card mt-5 p-4">
            <h5 class="card-title">ติดตามสถานะการแจ้งซ่อม</h5>
                <span class="text mb-4">กรอกหมายเลขเเท็ก 13 หลัก [ตัวอย่าง : EF582568151TH]</span>
            <div class="input-group mb-3">
                <input type="text" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fas fa-search" style="font-size: 30px;"></i>
                        </button>
                    </div>
                </input>
            </div>
            {{--  <span class="text mb-4">88 branding projects</span>
            <div class="d-flex flex-row justify-content-between mb-3">
                <div class="d-flex flex-column p-3"><p class="mb-1">Logo and marketing material design for Bakery</p> <small class="text-muted">8 days remaining</small>
                </div>
                <div class="price pt-3 pl-3">
                    <span class="mb-2">Fixed</span>
                    <h5><span>&dollar;</span>1,500</h5>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between mx-1">
                <div class="d-flex flex-column p-3"><p class="mb-1">Need to create brand guidelines for my brand</p> <small class="text-muted">12 days remaining</small>
                </div>
                <div class="price pt-3 pl-3">
                    <span class="mb-2">Hourly</span>
                    <h5><span>&dollar;</span>40</h5>
                </div>
            </div>  --}}
        </div>
    </div>
@endsection

@extends('layout.master')

@section('content')
<div class="container">
    <h3 class="mt-4">แก้ไขข้อมูลส่วนตัว</h3>
    <hr>

        <form>
            <div class="form-row">
                <div class="row m-1">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Username</label>
                        <input type="username" class="form-control" id="username" placeholder="Username">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                      </div>
                </div>
                <div class="row m-1">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">ชื่อ</label>
                        <input type="name" class="form-control" id="inputEmail4" placeholder="ชื่อ">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPassword4">นามสกุล</label>
                        <input type="surname" class="form-control" id="inputPassword4" placeholder="นามสกุล">
                      </div>
                </div>
                <div class="row m-1">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">เบอร์โทร</label>
                        <input type="phone" class="form-control" id="inputEmail4" placeholder="เบอร์โทร">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPassword4">Email</label>
                        <input type="Email" class="form-control" id="inputPassword4" placeholder="Email@gmail.com">
                      </div>
                </div>
                <br>
                <div class="row ">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success">บันทึกการแก้ไขข้อมูลส่วนตัว</button>
                    </div>

                </div>
            </div>

          </form>
</div>
@endsection

@extends('layout.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid px-4">
        <h1 class="mt-4">เพิ่มพนักงาน</h1>
        {{--  <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">เพิ่มพนักงาน</li>
        </ol>  --}}

        <div>
            <a href="{{route('employee.create')}}" class="btn btn-danger">กลับ</a>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('employee.update', $employee->id) }}" method="POST" action="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <strong>Employee Name</strong>
                        <input type="text" name="name" value="{{ $employee->name }}" class="form-control" placeholder="Employee Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group my-2">
                        <strong>Employee Email</strong>
                        <input type="email" name="email" value="{{ $employee->email }}" class="form-control" placeholder="Employee Email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group my-2">
                        <strong>Employee Address</strong>
                        <input type="text" name="address"  value="{{ $employee->address }}" class="form-control" placeholder="Employee Address">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3">ส่ง</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
@endsection

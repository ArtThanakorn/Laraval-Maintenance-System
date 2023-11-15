@extends('layout.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid px-4">
        <h1 class="mt-4">จัดการข้อมูลช่าง</h1>
        {{--  <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">เพิ่มสมาชิก</li>
        </ol>  --}}

            <div>
                <a href="{{route('employee.create')}}" class="btn btn-success my-3">เพิ่มพนักงาน</a>
            </div>
            @if ($message = Session::get('sucess'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Employee Address</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                <a href="{{ route('employee.edit',  $employee->id) }}" class="btn btn-warning">แก้ไข</a>
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$employees->links('pagination::bootstrap-5')}}
        </div>
    </div>
</body>
</html>
@endsection

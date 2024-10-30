@extends('layout.master')

@section('content')
<div class="container-fluid">
    <div class="card" >
        <div class="card-header">{{ 'พนักงานในแผนก' }}</div>
        <div class="card-body">
            <div class="table-responsive" >
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">{{ 'ลำดับ' }}</th>
                            <th scope="col">{{ 'ชื่อ-นามสกุล' }}</th>
                            <th scope="col">{{ 'ระดับ' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Departmentstaff as $key => $staff)
                            <tr>
                                <td scope="row">{{$key+1}}</td>
                                <td>{{$staff->name}}</td>
                                <td>{{'พนักงาน'}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        {{-- <div class="card-footer text-muted">Footer</div> --}}
    </div>
</div>
@endsection

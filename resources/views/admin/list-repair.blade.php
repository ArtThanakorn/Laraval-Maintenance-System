@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2 my-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ประเภทงานซ่อม</th>
                            <th scope="col">ชื่อผู้แจ้งซ่อม</th>
                            <th scope="col">รายละเอียดงานซ่อม</th>
                            <th scope="col">สถานที่</th>
                            <th scope="col">วันที่แจ้งซ่อม</th>
                            <th scope="col">สถานะงานเเจ้งซ่อม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($liRepair as $list)
                                <td scope="row">{{ $list->type }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->details }}</td>
                                <td>{{ $list->site }}</td>
                                <td>{{ $list->created_at }}</td>
                                <td>{{ $list->status_repair }}</td>
                            @endforeach

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

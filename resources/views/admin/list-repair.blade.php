@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row flex justify-content-center align-items-center g-2 my-3">
            <div class="card" style="width: 75rem; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="" id=""
                                aria-describedby="helpId" placeholder="" />
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <dic class="col">
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-primary">
                                        รอดำเมินการ
                                    </button>
                                </div>
                            </dic>
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-warning">
                                        อยู่ระหว่างดำเนินการ
                                    </button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <button type="button" name="" id="" class="btn btn-success">
                                        ดำเนินการเส็ดสิ้น
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
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
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liRepair as $list)
                                        <tr>
                                            <td scope="row">{{ $list->type }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->details }}</td>
                                            <td>{{ $list->site }}</td>
                                            <td>{{ $list->created_at }}</td>
                                            <td style="display:flex; height: 65px; align-items: center; justify-content: center;">
                                            
                                                <div 
                                                @switch($list->status_repair)
                                                    @case('รอดำเนินการ')
                                                    class="p-2"
                                                    @style(['color:#ffffff', 'background-color:#279fff', 'border-radius:15px','font-size:16px','width:auto',' text-align:center'])
                                                    @break
                                                    @case('อยู่ระหว่างดำเนินการ')
                                                    class="p-2"
                                                    @style(['color:#ffffff', 'background-color:#FDE767', 'border-radius:15px','font-size:16px','width:auto',' text-align:center',''])
                                                    @break
                                                    @case('ดำเนินการเส็ดสิ้น')
                                                    class="p-2"
                                                    @style(['color:#ffffff', 'background-color:#20c997', 'border-radius:15px','font-size:16px','width:auto',' text-align:center'])
                                                    @break
                                                 @endswitch
                                                >
                                                    {{ $list->status_repair }}
                                                </div>
                                            </td>
                                            <td><a name="" id="" class="btn btn-primary" href="{{route('handle.repair')}}"
                                                    role="button">จัดการ</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

    </div>
@endsection

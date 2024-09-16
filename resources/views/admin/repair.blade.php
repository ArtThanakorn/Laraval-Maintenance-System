@extends('layout.master')


@section('style')
    <link href="/css/repair_blade_admin.css" rel="stylesheet" />
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

<div class="container-fluid">
    <form method="POST" action="{{ route('add.repair') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-list"></i>
                {{ 'ฟอร์มเเจ้งซ่อม' }}
            </div>
            <div class="card-body">

                <div class="row justify-content-center align-items-center g-2">
                    <div class="row g-2">
                        <label for="headfromcheck">{{ 'ตำแหน่งผู้แจ้ง' }}</label>
                        <div class="fromCheck mb-2">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="statusRadio" value="อาจารย์"
                                        @if (old('statusRadio') == 'อาจารย์') checked @endif id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ 'อาจารย์' }}
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="statusRadio" value="เจ้าหน้าที่"
                                        @if (old('statusRadio') == 'เจ้าหน้าที่') checked @endif id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{ 'เจ้าหน้าที่' }}
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="statusRadio" value="นักศึกษา"
                                        @if (old('statusRadio') == 'นักศึกษา') checked @endif id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        {{ 'นักศึกษา' }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <span role="alert" class="text-danger">
                            @error('statusRadio')
                                <strong> {{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                </div>
                <input type="hidden" name="location" value="{{$rooms->name_room}}">
                <div class="row justify-content-center align-items-center g-2 mb-2">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col"><label for="" class="form-label">{{ 'ชื่อผู้เเจ้ง' }}</label></div>
                        <div class="col">
                            <label for="equipmentRoom">{{ 'อุปกรณ์' }}</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fas fa-user"></i>
                            </span>
                            <input class="form-control" type="text" name="chackname" value="{{ old('chackname') }}"
                                placeholder="*ชื่อ-นายสกุล">
                        </div>
                        <span role="alert" class="text-danger">
                            @error('chackname')
                                <strong> {{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fas fa-wrench"></i>
                            </span>
                            {{-- @dd($rooms) --}}
                            <select class="form-select" aria-label="Default select example" name="toolcheck" id="chacktype">
                                <option disabled selected>--เลือกอุปกรณ์ซ่อม--</option>

                                @foreach ($rooms->detail as $detail)
                                <option value="{{ $detail->name_equipment }}" @if (old('toolcheck') == $detail->name_equipment) selected @endif>{{ $detail->name_equipment }}</option>
                                {{-- <option value="{{ $tool->name_equipment }}" @if (old('toolcheck') == $tool->name_equipment) selected @endif>{{ $tool->name_equipment }}</option> --}}
                                {{-- {{ dd($detail) }} --}}
                                @endforeach
                            </select>
                        </div>
                        <span role="alert" class="text-danger">
                            @error('toolcheck')
                                <strong> {{ $message }}</strong>
                            @enderror
                        </span>
                    </div>


                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col"><label for="ProblemDetails">{{ 'รายละเอียดปัญหา' }}</label></div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fa fa-file-text"></i>
                            </span>
                            <input class="form-control" id="exampleFormControlTextarea1" value="{{ old('detail') }}"
                                placeholder="กรุณาระบุรายละเอียดปัญหา" name="detail">
                        </div>
                        <span role="alert" class="text-danger">
                            @error('detail')
                                <strong> {{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col"><label for="exampleFormControlInput1">{{ 'Email ผู้แจ้ง' }}</label></div>
                        <div class="col"><label for="exampleFormControlInput1">{{ 'เบอร์โทร' }}</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="far fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com" name="email" value="{{ old('email') }}">
                        </div>
                        <span role="alert" class="text-danger">
                            @error('email')
                                <strong> {{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="082-8376xxx" name="number" value="{{ old('number') }}">
                        </div>
                        <span role="alert" class="text-danger">
                            @error('number')
                                <strong> {{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <label for="formFileMultiple" class="form-label">{{ 'ภาพประกอบ' }}
                            <b class="text-danger">{{ '*เลือกรูปภาพได้ไม่เกิน 5 รูปภาพ' }}</b></label>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text bg-info">
                                <i class="fa fa-file-image"></i>
                            </span>
                            <input class="form-control" type="file" id="formFileMultiple" name="image[]"
                                value="{{ old('image') }}" multiple>
                        </div>
                        <span role="alert" class="text-danger">
                            @error('image')
                                <strong> {{ $message }}</strong>
                            @enderror
                            @error('image.*')
                                <strong> {{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="text-end">
                        <button type="submit" class="btn  btn-outline-success">{{ 'เเจ้งซ่อม' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
@endsection

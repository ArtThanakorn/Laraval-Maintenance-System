@extends('layout.master')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-2">
                <p class="mb-0">{{$rooms->name_room}}</p>
                <a href="" id="container">{!! $qrCodes !!}</a><br />
                <button id="download" class="mt-2 btn btn-info text-light" onclick="downloadSVG()">{{'Download QRCode'}}</button>
            </div>

        </div>
    @endsection

    @section('script')
        <script>
            let jsRooms = {!! json_encode($rooms) !!};

            function downloadSVG() {
                const svg = document.getElementById('container').innerHTML;
                const blob = new Blob([svg.toString()]);
                const element = document.createElement("a");
                element.download = `${jsRooms.name_room}.svg`;
                element.href = window.URL.createObjectURL(blob);
                element.click();
                element.remove();
            }
        </script>
    @endsection

@extends('layout.master')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-2">
                
                <a href="" id="container">{!! $qrCodes !!}</a><br />
                {{-- <button id="download" class="mt-2 btn btn-info text-light" onclick="downloadSVG()">Download SVG</button> --}}
            </div>

        </div>
    @endsection

    @section('script')
    <script>
         let jsRooms = {!! json_encode($rooms) !!};
        // โค้ดที่ต้องการให้ทำงานทันที
        console.log("Hello, world!");
        const svg = document.getElementById('container').innerHTML;
      const blob = new Blob([svg.toString()]);
      const element = document.createElement("a");
      element.download = `${jsRooms.name_room}.svg`;
      element.href = window.URL.createObjectURL(blob);
      element.click();
      element.remove();
      </script>
    @endsection
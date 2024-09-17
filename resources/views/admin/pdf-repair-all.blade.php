<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ตาราง Static</title>

    <style>
        /* เราจะใส่ CSS ที่นี่ */
        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabun.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabun Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabun';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabun Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabun';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabun Bold Italic.ttf') }}") format('truetype');
        }

        body {
            font-family: 'THSarabun';
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>{{ 'รายงาน จำนวนแจ้งซ่อม' }}</h2>
    {{-- @dd($pdfData) --}}
    <table>
        <tr>
            <th>{{ 'ลำดับ' }}</th>
            <th>{{ 'ประเภทงานซ่อม' }}</th>
            <th>{{ 'ชื่อผู้แจ้งซ่อม' }}</th>
            <th>{{ 'รายละเอียดงานซ่อม' }}</th>
            <th>{{ 'สถานที่' }}</th>
            <th>{{ 'รหัสแจ้งซ่อม' }}</th>
            <th>{{ 'สถานะงานเเจ้งซ่อม' }}</th>
            <th>{{ 'วันที่แจ้งซ่อม' }}</th>
        </tr>
        @foreach ($repair as $key =>$rows)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $rows->department_name }}</td>
                <td>{{ $rows->name }}</td>
                <td>{{ $rows->details }}</td>
                <td>{{ $rows->site }}</td>
                <td>{{ $rows->tag_repair }}</td>
                <td>{{ $rows->status_repair }}</td>
                <td>{{ $rows->created_at }}</td>
            </tr>
        @endforeach

    </table>

    <div>
        <p>{{'สรุปรายงานผล'}}</p>
        <table>
            <tr>
                <th>{{ 'งานทั้งหมด' }}</th>
                <th>{{ 'ดำเนินการเสร็จสิ้น' }}</th>
                <th>{{ 'รอดำเนินการ' }}</th>
            </tr>
            <tr>
                <td>{{ $all.' '.'งาน' }}</td>
                <td>{{ $finished.' '.'งาน' }}</td>
                <td>{{ $NotFinished.' '.'งาน' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>

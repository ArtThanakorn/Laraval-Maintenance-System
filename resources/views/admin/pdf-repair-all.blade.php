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
    <h2>{{ 'ตาราง Static' }}</h2>
    <p>{{ $users }}</p>
    {{-- @dd($pdfData) --}}
    {{-- <table>
        <tr>
            <th>{{ $tableHead['TH5'] }}</th>
            <th>{{ $tableHead['TH2'] }}</th>
            <th>{{ $tableHead['TH3'] }}</th>
            <th>{{ $tableHead['TH6'] }}</th>
            <th>{{ $tableHead['TH4'] }}</th>
        </tr>
        @foreach ($pdfData as $rows)
            <tr>
                <td>{{ $rows->id_repair }}</td>
                <td>{{ $rows->status }}</td>
                <td>{{ $rows->details }}</td>
                <td>{{ $rows->status_repair }}</td>
                <td>{{ $rows->site }}</td>
            </tr>
        @endforeach

    </table>

    <div>
        <p>{{'สรุปรายงานผล'}}</p>
        <table>
            <tr>
                <th>{{ 'ดำเนินการเสร็จสิ้น' }}</th>
                <th>{{ 'รอดำเนินการ' }}</th>
            </tr>
            <tr>
                <td>{{ $Completed.' '.'งาน' }}</td>
                <td>{{ $Pending.' '.'งาน' }}</td>
            </tr>
        </table>
    </div> --}}
</body>

</html>

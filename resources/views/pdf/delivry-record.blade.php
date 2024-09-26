<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>كشف</title>
    <style>

     
        body {
            direction: rtl;
        }
      

        body {
            font-family: sans-serif;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td, .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even){background-color: #f2f2f2;}

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            /*text-align: left;*/
            /*background-color: #04AA6D;*/
            /*color: white;*/
        }
        .container {
            padding: 10px 10px;
        }

        thead { display: table-header-group; }
        tfoot { display: table-row-group; }
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th align="center" colspan="3"><b>كشف الدورة الحالية </b></th>
            <th align="center" colspan="5"><b>{{__('Report Export Date :')." ".date('Y/m/d h:i A', strtotime('+3 hours'))}}</b></th>
        </tr>
        <tr></tr>
        <tr>
            <th align="center"><b>#</b></th>
            <th align="center">اسم الزوج</th>
            <th align="center">رقم الهوية</th>
            <!-- <th align="center">اسم الزوجة </th>
            <th align="center">رقم الهوية </th> -->
            <th align="center">نوع المساعدة </th>
            <th align="center">المندوب</th>
            <th align="center">رقم جوال المندوب</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
           
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ $item->beneficial->full_name }}</td>
                <td align="center">{{ $item->beneficial->id_num }}</td>
                <!-- <td align="center">{{ $item->beneficial->wife_name }}</td>
                <td align="center">{{ $item->beneficial->wife_id_num }}</td> -->
                <td align="center">{{ $item->product?->name . ' -' . $item->product?->provider->name }}</td>
                <td align="center">{{ $item->beneficial?->actor?->name }}</td>
                <td align="center">{{ $item->beneficial?->actor?->mobile_num }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

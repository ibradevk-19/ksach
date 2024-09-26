<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>فواتير</title>
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
            <th align="center" colspan="3"><b>فواتير المخزن</b></th>
            <th align="center" colspan="5"><b>{{__('Report Export Date :')." ".date('Y/m/d h:i A', strtotime('+3 hours'))}}</b></th>
        </tr>
        <tr></tr>
        <tr>
            <th align="center"><b>#</b></th>
            <th align="center">التاريخ</th>
            <th align="center">الحركة</th>
            <th align="center">المستلم </th>
            <th align="center">المورد </th>
            <th align="center">المنفذ </th>
            <th align="center">المنتج</th>
            <th align="center">التصنيف</th>
            <th align="center">الكمية</th>
            <th align="center">الوحدة</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
           
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ $invoice['date'] }}</td>
                <td align="center">{{ $invoice['type']}}</td>
                <td align="center">{{ $invoice['receiver_name'] }}</td>
                <td align="center">{{ $invoice['provider_name'] }}</td>
                <td align="center">{{ $invoice['port_name'] }}</td>
                <td align="center">{{ $invoice['product'] }}</td>
                <td align="center">{{ $invoice['category'] }}</td>
                <td align="center">{{ $invoice['quantity'] }}</td>
                <td align="center">{{ $invoice['unit'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/><br/><br/>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th align="center" colspan="3"><b>اجمالي المخزن</b></th>
        </tr>
        <tr></tr>
        <tr>
            <th align="center"><b>#</b></th>
            <th align="center">الإسم</th>
            <th align="center">المورد </th>
            <th align="center">الكمية</th>
            <th align="center">الوحدة</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
           
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ $product->name }}</td>
                <td align="center">{{ $product->provider->name }}</td>
                <td align="center">{{ $product->quantity }}</td>
                <td align="center">{{ $product->unit->name }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

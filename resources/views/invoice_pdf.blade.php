<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فواتير</title>
    <style>

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Arial', sans-serif;
                padding: 20px;
                background-color: #f9f9f9;
                direction: rtl; /* Set the document to RTL */
            }

            .invoice-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ddd;
            }

            .invoice-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
                flex-direction: row-reverse; /* Reverse the order of flex items */
            }

            .company-details h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .invoice-details {
                text-align: left; /* Align text to the left for RTL */
            }

            .billing-info {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
                flex-direction: row-reverse; /* Ensure billing info is in RTL */
            }

            .billing-info h3 {
                font-size: 18px;
                margin-bottom: 10px;
            }

            .invoice-items table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .invoice-items th, .invoice-items td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: right; /* Align table data to the right for RTL */
            }

            .invoice-items th {
                background-color: #f2f2f2;
            }

            .invoice-total {
                margin-top: 20px;
                text-align: left; /* Ensure totals align to the left in RTL */
            }

            .invoice-total table {
                width: auto;
                margin-right: auto; /* Ensure the table is aligned correctly */
            }

            .invoice-total td {
                padding: 5px 10px;
            }

            footer {
                text-align: center;
                margin-top: 30px;
                font-size: 14px;
                color: #777;
            }

    </style>
</head>
<body>
<div class="container">
<div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-container">
        <!-- Invoice Header -->
        <header class="invoice-header">
            <div class="company-details">
                <h1>المركز السعودي للثقافة و التراث</h1>
                <p> فلسطين ، خانيونس </p>
                <p>البريد الإلكتروني: info@ksach.org | الهاتف: +123 456 789</p>
            </div>
            <div class="invoice-details">
                <h2>فاتورة</h2>
                <p><strong>رقم الفاتورة:</strong> {{ $invoice->id }}</p>
                <p><strong>التاريخ:</strong>{{ $invoice->date }}</p>
            </div>
        </header>

        <!-- Billing Information -->
        <section class="billing-info">
            <div class="billing-from">
                <h3>فاتورة من</h3>
                <p>المركز السعودي للثقافة و التراث </p>
                <p>العنوان</p>
                <p> فلسطين ، خانيونس </p>
            </div>
            <div class="billing-to">
                <h3>فاتورة إلى</h3>
                <p> {{ $invoice->receiver_name }}</p>
            </div>
        </section>

        <!-- Invoice Table -->
        <section class="invoice-items">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الوصف</th>
                        <th>الكمية</th>
                        <th>الوحدة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td> 
                        <td align="center">{{ $item->product->name }}</td>
                        <td align="center">{{ $item->quantity }}</td>
                        <td align="center">{{ $item->unit->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <!-- Total Section -->
        <section class="invoice-total">
            <table>
                <!-- <tr>
                    <td>المجموع الفرعي:</td>
                    <td>$190.00</td>
                </tr>
                <tr>
                    <td>الضريبة (5%):</td>
                    <td>$9.50</td>
                </tr>
                <tr>
                    <td><strong>المجموع الكلي:</strong></td>
                    <td><strong>$199.50</strong></td>
                </tr> -->
            </table>
        </section>

        <!-- Footer -->
        <footer>
            <p>شكراً لتعاملكم معنا!</p>
        </footer>
    </div>
    </div>
</div>
</body>
</html>

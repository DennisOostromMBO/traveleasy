<!DOCTYPE html>
<html>
<head>
    <title>Factuur PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .footer {
            text-align: center;
            padding: 10px 0;
        }
        .header {
            border-bottom: 1px solid #ddd;
        }
        .footer {
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .invoice-details {
            margin: 20px 0;
        }
        .invoice-details th, .invoice-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .invoice-details th {
            background-color: #f0f0f0;
        }
        .invoice-details td {
            background-color: #fff;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }
        .logo span {
            color: #fff;
            background-color: #007BFF;
            padding: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                Travel<span>Easy</span>
            </div>
            <h1>Factuur</h1>
            <p>Factuurnummer: {{ $invoice->invoice_number }}</p>
            <p>Factuurdatum: {{ $invoice->invoice_date }}</p>
        </div>

        <div class="invoice-details">
            <table>
                <tr>
                    <th>Boeking ID</th>
                    <td>{{ $invoice->booking_id }}</td>
                </tr>
                <tr>
                    <th>Klantnaam</th>
                    <td>{{ $invoice->booking->customer->person->first_name }} {{ $invoice->booking->customer->person->last_name }}</td>
                </tr>
                <tr>
                    <th>Bedrag excl. BTW</th>
                    <td>{{ $invoice->amount_excl_vat }}</td>
                </tr>
                <tr>
                    <th>BTW</th>
                    <td>{{ $invoice->vat }}</td>
                </tr>
                <tr>
                    <th>Bedrag incl. BTW</th>
                    <td>{{ $invoice->amount_incl_vat }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $invoice->invoice_status }}</td>
                </tr>
                <tr>
                    <th>Opmerking</th>
                    <td>{{ $invoice->note }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Bedankt voor uw boeking bij TravelEasy!</p>
        </div>
    </div>
</body>
</html>

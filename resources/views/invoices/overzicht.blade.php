<!DOCTYPE html>
<html>
<head>
    <title>Invoices Overview</title>
    <!-- Add necessary CSS and JS files -->
</head>
<body>
    <h1>Invoices Overview</h1>
    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->booking_id }}</td>
                    <td>{{ $invoice->booking->customer->name }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>{{ $invoice->created_at }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}">View</a>
                        <a href="{{ route('invoices.generate', $invoice->booking_id) }}">Generate</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

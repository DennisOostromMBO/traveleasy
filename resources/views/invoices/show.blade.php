<!DOCTYPE html>
<html>
<head>
    <title>Factuur Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Factuur Details</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <table class="min-w-full bg-white">
                <tr>
                    <th class="py-3 px-4 text-left">Factuurnummer</th>
                    <td class="py-3 px-4">{{ $invoice->invoice_number }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Factuurdatum</th>
                    <td class="py-3 px-4">{{ $invoice->invoice_date }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Boeking ID</th>
                    <td class="py-3 px-4">{{ $invoice->booking_id }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Klantnaam</th>
                    <td class="py-3 px-4">{{ $invoice->booking->customer->person->first_name }} {{ $invoice->booking->customer->person->last_name }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Bedrag excl. BTW</th>
                    <td class="py-3 px-4">{{ $invoice->amount_excl_vat }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">BTW</th>
                    <td class="py-3 px-4">{{ $invoice->vat }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Bedrag incl. BTW</th>
                    <td class="py-3 px-4">{{ $invoice->amount_incl_vat }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Status</th>
                    <td class="py-3 px-4">{{ $invoice->invoice_status }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Opmerking</th>
                    <td class="py-3 px-4">{{ $invoice->note }}</td>
                </tr>
            </table>
            <div class="mt-6">
                <a href="{{ route('invoices.pdf', $invoice->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800">Download PDF</a>
            </div>
        </div>
    </div>
</body>
</html>

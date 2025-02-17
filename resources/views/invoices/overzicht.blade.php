<!DOCTYPE html>
<html>
<head>
    <title>Facturen Overzicht</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Facturen Overzicht</h1>
        <div class="mb-4">
            <a href="{{ route('invoices.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800">Nieuwe Factuur</a>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Factuur ID</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Boeking ID</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Klantnaam</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Bedrag</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Aangemaakt op</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Acties</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($invoices as $invoice)
                        <tr>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->id }}</td>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->booking_id }}</td>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->booking->customer->name }}</td>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->amount_incl_vat }}</td>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->invoice_status }}</td>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->created_at }}</td>
                            <td class="w-1/6 py-3 px-4">
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="text-blue-600 hover:underline">Bekijken</a>
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je deze factuur wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

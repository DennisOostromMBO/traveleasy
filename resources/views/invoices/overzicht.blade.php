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
                            <td class="w-1/6 py-3 px-4">{{ $invoice->amount }}</td>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->status }}</td>
                            <td class="w-1/6 py-3 px-4">{{ $invoice->created_at }}</td>
                            <td class="w-1/6 py-3 px-4">
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="text-blue-600 hover:underline">Bekijken</a>
                                <a href="{{ route('invoices.generate', $invoice->booking_id) }}" class="text-blue-600 hover:underline ml-2">Genereren</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

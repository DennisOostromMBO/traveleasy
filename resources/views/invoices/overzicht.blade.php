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
        <div class="mb-4">
            <form action="{{ route('invoices.index') }}" method="GET">
                <input type="text" name="search" placeholder="Zoeken..." class="w-full px-4 py-2 border rounded-lg" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800 mt-2">Zoeken</button>
            </form>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if($invoices->isEmpty())
                <div class="p-4 text-center text-gray-700">Geen facturen beschikbaar</div>
            @else
                <table class="min-w-full bg-white">
                    <thead class="bg-blue-600 text-white">
                        <tr>
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
                                <td class="w-1/6 py-3 px-4">{{ $invoice->booking->customer->person->first_name }} {{ $invoice->booking->customer->person->last_name }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $invoice->amount_incl_vat }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $invoice->invoice_status }}</td>
                                <td class="w-1/6 py-3 px-4">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}</td>
                                <td class="w-1/6 py-3 px-4">
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="text-blue-600 hover:underline">Bekijken</a>
                                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="text-blue-600 hover:underline ml-2">Bewerken</a>
                                    <a href="{{ route('invoices.pdf', $invoice->booking_id) }}" class="text-blue-600 hover:underline ml-2">Download PDF</a>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Weet je zeker dat je deze factuur wilt verwijderen?')">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="mt-4">
            {{ $invoices->links() }}
        </div>
    </div>
</body>
</html>

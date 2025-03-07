<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Manager Dashboard</h1>
        <div class="mb-4">
            <form action="{{ route('manager.bookings') }}" method="GET">
                <div class="flex space-x-4">
                    <input type="date" name="start_date" class="w-full px-4 py-2 border rounded-lg" required>
                    <input type="date" name="end_date" class="w-full px-4 py-2 border rounded-lg" required>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800">Toon boekingen</button>
                </div>
            </form>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if($bookings->isEmpty())
                <div class="p-4 text-center text-gray-700">Geen boekingen gevonden voor deze periode</div>
            @else
                <table class="min-w-full bg-white">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Klantnaam</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Reis</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Stoelnummer</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Prijs</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Datum</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="w-1/6 py-3 px-4">{{ $booking->customer->person->first_name }} {{ $booking->customer->person->last_name }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $booking->travel_id }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $booking->seat_number }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $booking->price }}</td>
                                <td class="w-1/6 py-3 px-4">{{ $booking->booking_status }}</td>
                                <td class="w-1/6 py-3 px-4">{{ \Carbon\Carbon::parse($booking->purchase_date)->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>

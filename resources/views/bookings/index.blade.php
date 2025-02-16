<!DOCTYPE html>
<html>
<head>
    <title>Boekingen Overzicht</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Boekingen Overzicht</h1>
        <div class="mb-4">
            <form action="{{ route('bookings.index') }}" method="GET">
                <input type="text" name="search" placeholder="Zoeken..." class="w-full px-4 py-2 border rounded-lg" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800 mt-2">Zoeken</button>
            </form>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Klantnaam</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Reis</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Stoelnummer</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Prijs</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Acties</th>
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
                            <td class="w-1/6 py-3 px-4">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:underline">Bekijken</a>
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="text-blue-600 hover:underline ml-2">Bewerken</a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je deze boeking wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</body>
</html>

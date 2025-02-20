<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vluchten Overzicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.navbar')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-4">
            <form action="{{ route('bookings.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Zoeken..." class="w-full px-4 py-2 border rounded-lg" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800 ml-2">Zoeken</button>
            </form>
        </div>
        @if(isset($errors) && $errors->has('search'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first('search') }}</span>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($bookings as $booking)
                <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-xs">
                    <!-- Vertrek & Bestemming -->
                    <div>
                        <p class="text-gray-800 font-semibold text-lg">{{ $booking->departure_country }}</p>
                        <p class="text-gray-600 text-md">{{ $booking->destination_country }}</p>
                    </div>

                    <!-- Datum -->
                    <div class="flex items-center text-gray-500 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 6h14M5 3h14a2 2 0 012 2v16a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                        <p>{{ $booking->departure_date}}</p>
                    </div>

                    <!-- Prijs en Boeken knop -->
                    <div class="border-t mt-4 pt-4 flex justify-between items-center">
                        <p class="text-gray-700">Vanaf <span class="font-bold text-lg">€{{ number_format($booking->price, 2) }}</span></p>
                        <a href="{{ route('bookings.show', $booking->booking_id) }}" class="bg-purple-700 text-white px-4 py-2 rounded-lg hover:bg-purple-800">Boek</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
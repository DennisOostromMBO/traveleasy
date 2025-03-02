<!-- filepath: /C:/Users/danie/OneDrive/Documenten/school mappen/Leerjaar 2/Project/Periode 3/traveleasy/resources/views/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TravelEasy</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Tailwind CSS CDN */
            @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
        </style>
    @endif
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <x-navbar />

    <div class="relative bg-cover bg-center h-screen" style="background-image: url('{{ asset('img/takeoff.png') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto px-4 py-16 text-center relative z-10 flex items-center justify-center h-full">
            <div>
                <h1 class="text-5xl font-bold text-white">Welkom bij TravelEasy</h1>
                <p class="mt-4 text-xl text-gray-200">Uw ultieme reisgenoot</p>
                <h2 class="mt-8 text-3xl font-semibold text-white">Ontdek nieuwe bestemmingen</h2>
                <p class="mt-4 text-lg text-gray-200">Verken de wereld met TravelEasy. Vind de beste plekken om te bezoeken, verblijven en dineren.</p>
                
                <!-- Search Bar -->
                <form action="{{ url('/bookings') }}" method="GET" class="mt-8 flex justify-center">
                    <input type="text" name="search" placeholder="Zoek bestemming" class="py-3 px-6 rounded-l-full border-none focus:outline-none w-64">
                    <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-r-full hover:bg-blue-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center text-blue-600">Waarom TravelEasy?</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-blue-600">Gemakkelijk te gebruiken</h3>
                <p class="mt-4 text-gray-600">Onze gebruiksvriendelijke interface maakt het eenvoudig om uw reis te plannen en te boeken.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-blue-600">Betaalbare prijzen</h3>
                <p class="mt-4 text-gray-600">Wij bieden de beste prijzen voor vluchten, hotels en activiteiten, zodat u meer kunt besparen.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-blue-600">24/7 Klantenservice</h3>
                <p class="mt-4 text-gray-600">Ons toegewijde ondersteuningsteam staat altijd klaar om u te helpen met uw vragen en zorgen.</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center text-blue-600">Populaire Bestemmingen</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ asset('img/destination1.png') }}" alt="Bestemming 1" class="w-full h-48 object-cover rounded-t-lg">
                <h3 class="text-2xl font-semibold text-blue-600 mt-4">Bagdad, Irak</h3>
                <p class="mt-4 text-gray-600">Ontdek de rijke geschiedenis en cultuur van Bagdad, een van de oudste steden ter wereld.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ asset('img/destination2.png') }}" alt="Bestemming 2" class="w-full h-48 object-cover rounded-t-lg">
                <h3 class="text-2xl font-semibold text-blue-600 mt-4">Tokyo, Japan</h3>
                <p class="mt-4 text-gray-600">Verken de bruisende metropool van Tokyo met zijn unieke mix van traditionele en moderne cultuur.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ asset('img/destination3.png') }}" alt="Bestemming 3" class="w-full h-48 object-cover rounded-t-lg">
                <h3 class="text-2xl font-semibold text-blue-600 mt-4">New York, USA</h3>
                <p class="mt-4 text-gray-600">Bezoek de stad die nooit slaapt en geniet van de iconische skyline en diverse buurten.</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center text-blue-600">Aanbieding</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $saleBooking = \App\Models\Booking::where('sale', '>', 0)->inRandomOrder()->first();
            @endphp
            @if($saleBooking)
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-blue-600">{{ $saleBooking->departure_country }} naar {{ $saleBooking->destination_country }}</h3>
                    <p class="mt-4 text-gray-600">Vertrek op {{ $saleBooking->departure_date }}</p>
                    <p class="mt-4 text-gray-600">Stoelnummer: {{ $saleBooking->seat_number }}</p>
                    <div class="mt-4">
                        <p class="text-gray-500 line-through">€{{ number_format($saleBooking->price, 2) }}</p>
                        <p class="text-red-600 font-bold text-lg">€{{ number_format($saleBooking->price * (1 - $saleBooking->sale / 100), 2) }}</p>
                    </div>
                    <a href="{{ route('bookings.show', $saleBooking->id) }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Bekijk aanbieding</a>
                </div>
            @endif
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('bookings.sales') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Bekijk alle aanbiedingen</a>
        </div>
    </div>

    <x-footer />
</body>
</html>
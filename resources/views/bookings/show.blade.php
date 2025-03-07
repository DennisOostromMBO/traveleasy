<!DOCTYPE html>
<html>
<head>
    <title>Boeking Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Boeking Details</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <table class="min-w-full bg-white">

                <tr>
                    <th class="py-3 px-4 text-left">Reis</th>
                    <td class="py-3 px-4">{{ $booking->departure_country}} - {{$booking->destination_country}}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Stoelnummer</th>
                    <td class="py-3 px-4">{{ $booking->seat_number }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Prijs</th>
                    <td class="py-3 px-4">{{ $booking->price }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Status</th>
                    <td class="py-3 px-4">{{ $booking->booking_status }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Speciale Verzoeken</th>
                    <td class="py-3 px-4">{{ $booking->special_requests }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-4 text-left">Opmerking</th>
                    <td class="py-3 px-4">{{ $booking->note }}</td>
                </tr>
            </table>
            <div class="mt-6">
                <a href="{{ route('bookings.purchase', $booking->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Kopen
                </a>
            </div>
        </div>
    </div>
</body>
</html>

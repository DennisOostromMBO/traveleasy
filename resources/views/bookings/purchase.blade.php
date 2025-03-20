<!DOCTYPE html>
<html>
<head>
    <title>Betaling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Betaling</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <p class="text-lg mb-4">U staat op het punt om te betalen voor de volgende boeking:</p>
            <ul class="mb-4">
                <li><strong>Reis:</strong> {{ $booking->departure_country }} - {{ $booking->destination_country }}</li>
                <li><strong>Prijs:</strong> €{{ number_format($booking->price, 2) }}</li>
                <li><strong>Stoelnummer:</strong> {{ $booking->seat_number }}</li>
            </ul>
            <form action="{{ route('bookings.completePayment', $booking->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Betaal Nu
                </button>
            </form>
        </div>
    </div>
</body>
</html>
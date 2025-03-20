<!DOCTYPE html>
<html>
<head>
    <title>Boeking Bewerken</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Boeking Bewerken</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="seat_number" class="block text-gray-700">Stoelnummer</label>
                    <input type="text" name="seat_number" id="seat_number" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ $booking->seat_number }}" required>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Prijs</label>
                    <input type="number" step="0.01" name="price" id="price" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ $booking->price }}" {{ $booking->booking_status === 'Bevestigd' ? 'readonly' : '' }} required>
                </div>
                <div class="mb-4">
                    <label for="booking_status" class="block text-gray-700">Boekingsstatus</label>
                    <input type="text" name="booking_status" id="booking_status" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ $booking->booking_status }}" required>
                </div>
                <div class="mb-4">
                    <label for="special_requests" class="block text-gray-700">Speciale Verzoeken</label>
                    <textarea name="special_requests" id="special_requests" class="w-full p-2 border border-gray-300 rounded mt-1">{{ $booking->special_requests }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="note" class="block text-gray-700">Opmerking</label>
                    <textarea name="note" id="note" class="w-full p-2 border border-gray-300 rounded mt-1">{{ $booking->note }}</textarea>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700" onclick="return confirm('Weet u zeker dat u deze boeking wilt bijwerken?')">Boeking Bijwerken</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

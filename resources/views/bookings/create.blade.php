<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe Boeking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Nieuwe Boeking</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="customer_id" class="block text-gray-700">Klant ID</label>
                    <input type="text" name="customer_id" id="customer_id" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="travel_id" class="block text-gray-700">Reis ID</label>
                    <input type="text" name="travel_id" id="travel_id" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="seat_number" class="block text-gray-700">Stoelnummer</label>
                    <input type="text" name="seat_number" id="seat_number" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="purchase_date" class="block text-gray-700">Aankoopdatum</label>
                    <input type="date" name="purchase_date" id="purchase_date" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="purchase_time" class="block text-gray-700">Aankooptijd</label>
                    <input type="time" name="purchase_time" id="purchase_time" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="booking_status" class="block text-gray-700">Boekingsstatus</label>
                    <input type="text" name="booking_status" id="booking_status" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Prijs</label>
                    <input type="number" step="0.01" name="price" id="price" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700">Aantal</label>
                    <input type="number" name="quantity" id="quantity" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="special_requests" class="block text-gray-700">Speciale Verzoeken</label>
                    <textarea name="special_requests" id="special_requests" class="w-full p-2 border border-gray-300 rounded mt-1"></textarea>
                </div>
                <div class="mb-4">
                    <label for="is_active" class="block text-gray-700">Actief</label>
                    <select name="is_active" id="is_active" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="note" class="block text-gray-700">Opmerking</label>
                    <textarea name="note" id="note" class="w-full p-2 border border-gray-300 rounded mt-1"></textarea>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Boeking Aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

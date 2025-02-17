<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe Factuur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script>
        function calculateVAT() {
            const amountInclVAT = parseFloat(document.getElementById('amount_incl_vat').value) || 0;
            const vat = amountInclVAT * 0.21;
            const amountExclVAT = amountInclVAT - vat;
            document.getElementById('vat').value = vat.toFixed(2);
            document.getElementById('amount_excl_vat').value = amountExclVAT.toFixed(2);
        }
    </script>
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Nieuwe Factuur</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="booking_id" class="block text-gray-700">Boeking</label>
                    <select name="booking_id" id="booking_id" class="w-full px-4 py-2 border rounded-lg" required>
                        @foreach($bookings as $booking)
                            <option value="{{ $booking->id }}">{{ $booking->id }} - {{ $booking->customer->person->first_name }} {{ $booking->customer->person->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="invoice_date" class="block text-gray-700">Factuurdatum</label>
                    <input type="date" name="invoice_date" id="invoice_date" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="amount_incl_vat" class="block text-gray-700">Bedrag incl. BTW</label>
                    <input type="text" name="amount_incl_vat" id="amount_incl_vat" class="w-full px-4 py-2 border rounded-lg" required oninput="calculateVAT()">
                </div>
                <div class="mb-4">
                    <label for="vat" class="block text-gray-700">BTW</label>
                    <input type="text" name="vat" id="vat" class="w-full px-4 py-2 border rounded-lg" readonly>
                </div>
                <div class="mb-4">
                    <label for="amount_excl_vat" class="block text-gray-700">Bedrag excl. BTW</label>
                    <input type="text" name="amount_excl_vat" id="amount_excl_vat" class="w-full px-4 py-2 border rounded-lg" readonly>
                </div>
                <div class="mb-4">
                    <label for="invoice_status" class="block text-gray-700">Status</label>
                    <select name="invoice_status" id="invoice_status" class="w-full px-4 py-2 border rounded-lg" required>
                        <option value="In afwachting">In afwachting</option>
                        <option value="Betaald">Betaald</option>
                        <option value="Geannuleerd">Geannuleerd</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="is_active" class="block text-gray-700">Actief</label>
                    <select name="is_active" id="is_active" class="w-full px-4 py-2 border rounded-lg" required>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="note" class="block text-gray-700">Opmerking</label>
                    <textarea name="note" id="note" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

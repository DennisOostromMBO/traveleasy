<!DOCTYPE html>
<html>
<head>
    <title>Factuur Bewerken</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Factuur Bewerken</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="booking_id" class="block text-gray-700">Boeking</label>
                    <select name="booking_id" id="booking_id" class="w-full px-4 py-2 border rounded-lg" required>
                        @foreach($bookings as $booking)
                            <option value="{{ $booking->id }}" {{ $booking->id == $invoice->booking_id ? 'selected' : '' }}>
                                {{ $booking->id }} - {{ $booking->customer->person->first_name }} {{ $booking->customer->person->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="invoice_date" class="block text-gray-700">Factuurdatum</label>
                    <input type="date" name="invoice_date" id="invoice_date" class="w-full px-4 py-2 border rounded-lg" value="{{ $invoice->invoice_date }}" required>
                </div>
                <div class="mb-4">
                    <label for="invoice_status" class="block text-gray-700">Status</label>
                    <select name="invoice_status" id="invoice_status" class="w-full px-4 py-2 border rounded-lg" required>
                        <option value="In afwachting" {{ $invoice->invoice_status == 'In afwachting' ? 'selected' : '' }}>In afwachting</option>
                        <option value="Betaald" {{ $invoice->invoice_status == 'Betaald' ? 'selected' : '' }}>Betaald</option>
                        <option value="Geannuleerd" {{ $invoice->invoice_status == 'Geannuleerd' ? 'selected' : '' }}>Geannuleerd</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="is_active" class="block text-gray-700">Actief</label>
                    <select name="is_active" id="is_active" class="w-full px-4 py-2 border rounded-lg" required>
                        <option value="1" {{ $invoice->is_active ? 'selected' : '' }}>Ja</option>
                        <option value="0" {{ !$invoice->is_active ? 'selected' : '' }}>Nee</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="note" class="block text-gray-700">Opmerking</label>
                    <textarea name="note" id="note" class="w-full px-4 py-2 border rounded-lg">{{ $invoice->note }}</textarea>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Factuur Bijwerken</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

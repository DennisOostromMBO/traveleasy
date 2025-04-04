<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .collapse-content {
            display: none;
        }
    </style>
    <script>
        function toggleCollapse(id) {
            const content = document.getElementById(id);
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const destinationsCtx = document.getElementById('destinationsChart').getContext('2d');
            const startingPointsCtx = document.getElementById('startingPointsChart').getContext('2d');

            const destinationsChart = new Chart(destinationsCtx, {
                type: 'bar',
                data: {
                    labels: @json($popularDestinations->keys()),
                    datasets: [{
                        label: 'Populaire Bestemmingen',
                        data: @json($popularDestinations->values()),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const startingPointsChart = new Chart(startingPointsCtx, {
                type: 'bar',
                data: {
                    labels: @json($popularStartingPoints->keys()),
                    datasets: [{
                        label: 'Populaire Vertrekpunten',
                        data: @json($popularStartingPoints->values()),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
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
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="flex justify-between items-center bg-blue-600 text-white py-2 px-4 cursor-pointer" onclick="toggleCollapse('graphsSection')">
                <h2 class="text-xl font-semibold">Grafieken</h2>
                <span id="graphsToggle" class="text-2xl">+</span>
            </div>
            <div id="graphsSection" class="collapse-content">
                <canvas id="destinationsChart" class="mb-6"></canvas>
                <canvas id="startingPointsChart" class="mb-6"></canvas>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
            <div class="flex justify-between items-center bg-blue-600 text-white py-2 px-4 cursor-pointer" onclick="toggleCollapse('bookingsSection')">
                <h2 class="text-xl font-semibold">Boekingen</h2>
                <span id="bookingsToggle" class="text-2xl">+</span>
            </div>
            <div id="bookingsSection" class="collapse-content">
                @if($bookings->isEmpty())
                    <div class="p-4 text-center text-gray-700">Geen boekingen gevonden voor deze periode</div>
                @else
                    <table class="min-w-full bg-white">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Klantnaam</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Vertrekpunt</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Bestemming</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Stoelnummer</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Prijs</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Datum</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Acties</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($bookings as $booking)
                                <tr>
                                    <td class="w-1/6 py-3 px-4 cursor-pointer" onclick="toggleCollapse('collapse-{{ $booking->id }}')">{{ $booking->customer->person->first_name }} {{ $booking->customer->person->last_name }}</td>
                                    <td class="w-1/6 py-3 px-4">{{ $booking->departure_country }}</td>
                                    <td class="w-1/6 py-3 px-4">{{ $booking->destination_country }}</td>
                                    <td class="w-1/6 py-3 px-4">{{ $booking->seat_number }}</td>
                                    <td class="w-1/6 py-3 px-4">{{ $booking->price }}</td>
                                    <td class="w-1/6 py-3 px-4">{{ $booking->booking_status }}</td>
                                    <td class="w-1/6 py-3 px-4">{{ \Carbon\Carbon::parse($booking->purchase_date)->format('d-m-Y') }}</td>
                                    <td class="w-1/6 py-3 px-4">
                                        <button onclick="toggleCollapse('collapse-{{ $booking->id }}')" class="bg-blue-600 text-white py-1 px-2 rounded hover:bg-blue-800">Details</button>
                                    </td>
                                </tr>
                                <tr id="collapse-{{ $booking->id }}" class="collapse-content">
                                    <td colspan="8" class="py-3 px-4">
                                        <div class="bg-gray-100 p-4 rounded">
                                            <p><strong>Speciale Verzoeken:</strong> {{ $booking->special_requests }}</p>
                                            <p><strong>Opmerking:</strong> {{ $booking->note }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
            <div class="flex justify-between items-center bg-blue-600 text-white py-2 px-4 cursor-pointer" onclick="toggleCollapse('invoicesSection')">
                <h2 class="text-xl font-semibold">Betaalde Facturen</h2>
                <span id="invoicesToggle" class="text-2xl">+</span>
            </div>
            <div id="invoicesSection" class="collapse-content">
                @if($paidInvoices->isEmpty())
                    <div class="p-4 text-center text-gray-700">Geen betaalde facturen gevonden</div>
                @else
                    <table class="min-w-full bg-white">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Factuurnummer</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Bedrag (incl. BTW)</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Factuurdatum</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Opmerking</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($paidInvoices as $invoice)
                                <tr>
                                    <td class="py-3 px-4">{{ $invoice->invoice_number }}</td>
                                    <td class="py-3 px-4">€{{ number_format($invoice->amount_incl_vat, 2) }}</td>
                                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}</td>
                                    <td class="py-3 px-4">{{ $invoice->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const graphsToggle = document.getElementById('graphsToggle');
            const bookingsToggle = document.getElementById('bookingsToggle');
            const invoicesToggle = document.getElementById('invoicesToggle');

            graphsToggle.addEventListener('click', function () {
                graphsToggle.textContent = graphsToggle.textContent === '+' ? '-' : '+';
            });

            bookingsToggle.addEventListener('click', function () {
                bookingsToggle.textContent = bookingsToggle.textContent === '+' ? '-' : '+';
            });

            invoicesToggle.addEventListener('click', function () {
                invoicesToggle.textContent = invoicesToggle.textContent === '+' ? '-' : '+';
            });
        });
    </script>
</body>
</html>

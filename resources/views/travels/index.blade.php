<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reizenoverzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-7xl">
        <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Reizen</h1>
        @if(count($travels) > 0)
            <table class="min-w-full bg-white border border-gray-200 text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 border-b">Medewerker</th>
                        <th class="py-3 px-4 border-b">Vertrek</th>
                        <th class="py-3 px-4 border-b">Bestemming</th>
                        <th class="py-3 px-4 border-b">Vluchtnummer</th>
                        <th class="py-3 px-4 border-b">Vertrekdatum</th>
                        <th class="py-3 px-4 border-b">Vertrektijd</th>
                        <th class="py-3 px-4 border-b">Aankomstdatum</th>
                        <th class="py-3 px-4 border-b">Aankomsttijd</th>
                        <th class="py-3 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($travels as $travel)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $travel->employee_name }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->departure_country }} - {{ $travel->departure_airport }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->destination_country }} - {{ $travel->destination_airport }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->flight_number }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->departure_date }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->departure_time }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->arrival_date }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->arrival_time }}</td>
                            <td class="py-3 px-4 border-b">{{ $travel->travel_status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Geen reizen gevonden</p>
        @endif
    </div>
</body>
</html>
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
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Reizen</h1>
            <a href="{{ route('travels.create') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Nieuwe Reis</a>
        </div>

        <div class="mb-4">
            <form method="GET" action="{{ route('travels.index') }}" class="flex items-center gap-4">
                <select name="employee_id" class="p-2 border rounded">
                    <option value="">-- Filter op medewerker --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employeeId == $employee->id ? 'selected' : '' }}>
                            {{ $employee->full_name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Filter</button>
                <a href="{{ route('travels.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Reset</a>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

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
                        <th class="py-3 px-4 border-b">Acties</th>
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
                            <td class="py-3 px-4 border-b flex flex-col gap-2">
                                <a href="{{ route('travels.edit', $travel->travel_id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">Bewerken</a>
                                @if($travel->travel_status === 'Geannuleerd')
                                    <form method="POST" action="{{ route('travels.destroy', $travel->travel_id) }}" onsubmit="return confirm('Weet je zeker dat je deze reis wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Verwijderen</button>
                                    </form>
                                @else
                                    <button class="bg-gray-400 text-white py-1 px-3 rounded cursor-not-allowed" disabled>Verwijderen</button>
                                @endif
                            </td>
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
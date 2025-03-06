<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Reis Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

@if(session('success'))
    <div id="success-message" class="bg-green-500 text-white p-3 rounded-md mb-4 text-center">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
            window.location.href = "{{ route('travels.index') }}";
        }, 5000);
    </script>
@endif

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Nieuwe Reis Toevoegen</h1>
        <form action="{{ route('travels.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Medewerker:</label>
                <select name="employee_id" class="w-full p-2 border rounded">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Vertrek:</label>
                <select name="departure_id" class="w-full p-2 border rounded">
                    @foreach($departures as $departure)
                        <option value="{{ $departure->id }}">{{ $departure->country }} - {{ $departure->airport }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Bestemming:</label>
                <select name="destination_id" class="w-full p-2 border rounded">
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}">{{ $destination->country }} - {{ $destination->airport }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Vluchtnummer:</label>
                <input type="text" name="flight_number" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Vertrekdatum:</label>
                <input type="date" name="departure_date" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Vertrektijd:</label>
                <input type="time" name="departure_time" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Aankomstdatum:</label>
                <input type="date" name="arrival_date" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Aankomsttijd:</label>
                <input type="time" name="arrival_time" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Status:</label>
                <select name="travel_status" class="w-full p-2 border rounded">
                    <option value="Gepland">Gepland</option>
                    <option value="Uitgevoerd">Uitgevoerd</option>
                    <option value="Geannuleerd">Geannuleerd</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded">Opslaan</button>
        </form>
    </div>
</body>
</html>

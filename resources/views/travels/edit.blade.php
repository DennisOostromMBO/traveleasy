<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reis Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Reis Bewerken</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-md mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('travels.update', $travel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-medium">Medewerker:</label>
                <select name="employee_id" class="w-full p-2 border rounded">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == $travel->employee_id ? 'selected' : '' }}>{{ $employee->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Vertrek:</label>
                <select name="departure_id" class="w-full p-2 border rounded">
                    @foreach($departures as $departure)
                        <option value="{{ $departure->id }}" {{ $departure->id == $travel->departure_id ? 'selected' : '' }}>{{ $departure->country }} - {{ $departure->airport }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Bestemming:</label>
                <select name="destination_id" class="w-full p-2 border rounded">
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}" {{ $destination->id == $travel->destination_id ? 'selected' : '' }}>{{ $destination->country }} - {{ $destination->airport }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Vertrekdatum:</label>
                <input type="date" name="departure_date" class="w-full p-2 border rounded" value="{{ old('departure_date', $travel->departure_date) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Vertrektijd:</label>
                <input type="time" name="departure_time" class="w-full p-2 border rounded" value="{{ old('departure_time', \Carbon\Carbon::parse($travel->departure_time)->format('H:i')) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Aankomstdatum:</label>
                <input type="date" name="arrival_date" class="w-full p-2 border rounded" value="{{ old('arrival_date', $travel->arrival_date) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Aankomsttijd:</label>
                <input type="time" name="arrival_time" class="w-full p-2 border rounded" value="{{ old('arrival_time', \Carbon\Carbon::parse($travel->arrival_time)->format('H:i')) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Status:</label>
                <select name="travel_status" class="w-full p-2 border rounded">
                    <option value="Gepland" {{ old('travel_status', $travel->travel_status) == 'Gepland' ? 'selected' : '' }}>Gepland</option>
                    <option value="Uitgevoerd" {{ old('travel_status', $travel->travel_status) == 'Uitgevoerd' ? 'selected' : '' }}>Uitgevoerd</option>
                    <option value="Geannuleerd" {{ old('travel_status', $travel->travel_status) == 'Geannuleerd' ? 'selected' : '' }}>Geannuleerd</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded">Opslaan</button>
        </form>

        <div class="mt-4">
            <a href="{{ route('travels.index') }}" class="w-full bg-gray-500 text-white p-3 rounded block text-center">Terug naar overzicht</a>
        </div>
    </div>
</body>
</html>

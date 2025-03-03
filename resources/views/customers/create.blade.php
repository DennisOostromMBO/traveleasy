<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nieuwe Klant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .input-container {
            position: relative;
        }

        .error-message {
            position: absolute;
            top: -20px; 
            left: 0;
            color: #e53e3e;
            font-size: 0.875rem; 
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h1 class="text-3xl font-bold mb-6 text-center">Nieuwe Klant Toevoegen</h1>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <!-- Persoonlijke Gegevens Sectie -->
            <div class="space-y-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-700">Persoonlijke Gegevens</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Voornaam</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="Jan">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Tussenvoegsel</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="van der">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Achternaam</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="Berg">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Geboortedatum</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Paspoort Details</label>
                        <input type="text" name="passport_details" value="{{ old('passport_details') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="NW2XX3B4">
                    </div>
                </div>
            </div>

            <!-- Contact Informatie Sectie -->
            <div class="space-y-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-700">Contact Informatie</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Straatnaam</label>
                        <input type="text" name="street_name" value="{{ old('street_name') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="Hoofdstraat">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Huisnummer</label>
                        <input type="text" name="house_number" value="{{ old('house_number') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="42">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Toevoeging</label>
                        <input type="text" name="addition" value="{{ old('addition') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="A">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Postcode</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="1234AB">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Plaats</label>
                        <input type="text" name="city" value="{{ old('city') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="Amsterdam">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Mobiel</label>
                        <input type="tel" name="mobile" value="{{ old('mobile') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="0612345678">
                    </div>

                    <div class="mb-4 input-container">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                               placeholder="jan.berg@email.nl">
                    </div>
                </div>
            </div>

            <!-- Opslaan Button -->
            <div class="flex justify-end items-center space-x-4">
                <a href="{{ route('customers.index') }}" 
                   class="bg-gray-100 text-blue-500 px-6 py-2 rounded-lg hover:bg-gray-200 border border-gray-300">
                    Terug naar Overzicht
                </a>
                <button type="submit" 
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Klant Toevoegen
                </button>
            </div>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klant Bewerken</title>
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
        <h1 class="text-3xl font-bold mb-6 text-center">Klant Gegevens Bewerken</h1>

        <form action="{{ route('customers.update', $customer->person_id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="page" value="{{ request('page', 1) }}">

            @if ($errors->has('email_exists'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong>Let op!</strong> {{ $errors->first('email_exists') }}
                </div>
            @endif

            @if ($errors->has('mobile_exists'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong>Let op!</strong> {{ $errors->first('mobile_exists') }}
                </div>
            @endif

            <!-- Persoonlijke Gegevens Sectie -->
            <div class="space-y-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-700">Persoonlijke Gegevens</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4 input-container">
                        @error('first_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Voornaam</label>
                        <input type="text" 
                               id="first_name" 
                               name="first_name" 
                               value="{{ old('first_name', $customer->first_name) }}" 
                               class="mt-1 block w-full p-3 border @error('first_name') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="Jan">
                    </div>

                    <div class="mb-4 input-container">
                        @error('middle_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Tussenvoegsel</label>
                        <input type="text" 
                               id="middle_name" 
                               name="middle_name" 
                               value="{{ old('middle_name', $customer->middle_name) }}" 
                               class="mt-1 block w-full p-3 border @error('middle_name') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="van der">
                    </div>

                    <div class="mb-4 input-container">
                        @error('last_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Achternaam</label>
                        <input type="text" 
                               id="last_name" 
                               name="last_name" 
                               value="{{ old('last_name', $customer->last_name) }}" 
                               class="mt-1 block w-full p-3 border @error('last_name') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="Berg">
                    </div>

                    <div class="mb-4 input-container">
                        @error('date_of_birth')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Geboortedatum</label>
                        <input type="date" 
                               id="date_of_birth" 
                               name="date_of_birth" 
                               value="{{ old('date_of_birth', $customer->date_of_birth) }}" 
                               class="mt-1 block w-full p-3 border @error('date_of_birth') border-red-500 @else border-gray-300 @enderror rounded-md">
                    </div>

                    <div class="mb-4 input-container">
                        @error('passport_details')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="passport_details" class="block text-sm font-medium text-gray-700">Paspoort Details</label>
                        <input type="text" 
                               id="passport_details" 
                               name="passport_details" 
                               value="{{ old('passport_details', $customer->passport_details) }}" 
                               class="mt-1 block w-full p-3 border @error('passport_details') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="NW2XX3B4">
                    </div>
                </div>
            </div>

            <!-- Contact Informatie Sectie -->
            <div class="space-y-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-700">Contact Informatie</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4 input-container">
                        @error('street_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="street_name" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                        <input type="text" 
                               id="street_name" 
                               name="street_name" 
                               value="{{ old('street_name', $customer->street_name) }}" 
                               class="mt-1 block w-full p-3 border @error('street_name') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="Hoofdstraat">
                    </div>

                    <div class="mb-4 input-container">
                        @error('house_number')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="house_number" class="block text-sm font-medium text-gray-700">Huisnummer</label>
                        <input type="text" 
                               id="house_number" 
                               name="house_number" 
                               value="{{ old('house_number', $customer->house_number) }}" 
                               class="mt-1 block w-full p-3 border @error('house_number') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="42">
                    </div>

                    <div class="mb-4 input-container">
                        @error('addition')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="addition" class="block text-sm font-medium text-gray-700">Toevoeging</label>
                        <input type="text" 
                               id="addition" 
                               name="addition" 
                               value="{{ old('addition', $customer->addition) }}" 
                               class="mt-1 block w-full p-3 border @error('addition') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="A">
                    </div>

                    <div class="mb-4 input-container">
                        @error('postal_code')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Postcode</label>
                        <input type="text" 
                               id="postal_code" 
                               name="postal_code" 
                               value="{{ old('postal_code', $customer->postal_code) }}" 
                               class="mt-1 block w-full p-3 border @error('postal_code') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="1234AB">
                    </div>

                    <div class="mb-4 input-container">
                        @error('city')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="city" class="block text-sm font-medium text-gray-700">Plaats</label>
                        <input type="text" 
                               id="city" 
                               name="city" 
                               value="{{ old('city', $customer->city) }}" 
                               class="mt-1 block w-full p-3 border @error('city') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="Amsterdam">
                    </div>

                    <div class="mb-4 input-container">
                        @error('mobile')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="mobile" class="block text-sm font-medium text-gray-700">Mobiel</label>
                        <input type="tel" 
                               id="mobile" 
                               name="mobile" 
                               value="{{ old('mobile', $customer->mobile) }}" 
                               class="mt-1 block w-full p-3 border @error('mobile') border-red-500 @else border-gray-300 @enderror rounded-md"
                               placeholder="0612345678">
                    </div>

                    <div class="mb-4 input-container">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $customer->email) }}" 
                               class="mt-1 block w-full p-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md"
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
                    Opslaan
                </button>
            </div>
        </form>
    </div>
</body>
</html>

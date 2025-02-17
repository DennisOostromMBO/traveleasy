<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klanten</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @if ($tableEmpty)
        <meta http-equiv="refresh" content="4; url={{ url('/') }}">
    @endif
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-7xl">
        <!-- Link to Homepage -->
        <div class="mb-6 text-left">
            <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Terug naar de homepage</a>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Klanten</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ url('/customers') }}" class="mb-6">
            <div class="flex items-center gap-2">
                <div class="flex-grow flex items-center">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Zoek op achternaam" class="border border-gray-300 p-2 rounded-lg w-full">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">Zoek</button>
                </div>
                <button type="button" id="globalVisibilityToggle" class="bg-white p-2.5 rounded-lg shadow border border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                    <span class="text-xl" title="Toon/verberg telefoonnummers">👁️</span>
                </button>
            </div>
        </form>

        <!-- Customer List -->
        @if ($tableEmpty)
            <h3 class="text-red-500 text-center">Momenteel geen klantgegevens beschikbaar.</h3>
            <h3 class="text-red-500 text-center">Je wordt binnen 4 seconden teruggestuurd naar de homepage.</h3>
        @elseif ($customers->isEmpty())
            <h3 class="text-red-500 text-center">Geen klant met deze achternaam gevonden.</h3>
        @else
            <div class="hidden md:block overflow-x-auto">
                <!-- Standard table for larger screens -->
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-800 text-sm font-medium leading-normal">
                            <th class="py-3 px-4 border-b text-left font-semibold">Naam</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Leeftijdscategorie</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Paspoort details</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Adres</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Email</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Mobiel</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Relatienummer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $customer->full_name }}</td>
                                <td class="py-3 px-4 border-b">{{ $customer->age_category }}</td>
                                <td class="py-3 px-4 border-b">{{ $customer->passport_details }}</td>
                                <td class="py-3 px-4 border-b">{{ $customer->full_address }}</td>
                                <td class="py-3 px-4 border-b">{{ $customer->email }}</td>
                                <td class="py-3 px-4 border-b">
                                    <span class="phone no-underline" data-phone="{{ $customer->mobile }}">06********</span>
                                </td>
                                <td class="py-3 px-4 border-b">{{ $customer->relation_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card view for small screens -->
            <div class="block md:hidden grid gap-4">
                @foreach ($customers as $customer)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md border border-gray-200">
                        <div class="mb-2">
                            <span class="font-semibold">Naam:</span>
                            <span>{{ $customer->full_name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Leeftijdscategorie:</span>
                            <span>{{ $customer->age_category }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Paspoort details:</span>
                            <span>{{ $customer->passport_details }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Adres:</span>
                            <span>{{ $customer->full_address }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Email:</span>
                            <span>{{ $customer->email }}</span>
                        </div>
                        <div class="mb-2 flex items-center">
                            <span class="font-semibold">Mobiel:</span>
                            <span class="phone ml-2 no-underline" data-phone="{{ $customer->mobile }}">06********</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Relatienummer:</span>
                            <span>{{ $customer->relation_number }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
    <script>
        let numbersVisible = false;
        
        document.getElementById('globalVisibilityToggle').addEventListener('click', function() {
            numbersVisible = !numbersVisible;
            document.querySelectorAll('.phone').forEach(span => {
                span.textContent = numbersVisible ? span.getAttribute('data-phone') : '06********';
            });
            
            // Update button appearance
            this.classList.toggle('active');
        });
    </script>
    <style>
        #globalVisibilityToggle {
            transition: transform 0.2s;
        }
        
        #globalVisibilityToggle:hover {
            transform: scale(1.1);
        }
        
        #globalVisibilityToggle.active {
            background-color: #e5e7eb;
        }
        
        .no-underline {
            text-decoration: none;
        }
    </style>
</body>
</html>
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

    <div class="bg-white p-4 sm:p-6 md:p-8 rounded-lg shadow-lg w-full max-w-7xl">
        <!-- Link to Homepage -->
        <div class="mb-4 text-left">
            <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Terug naar de homepage</a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
            <h1 class="text-2xl font-bold">Klanten</h1>
            <a href="{{ route('customers.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Nieuwe Klant
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ url('/customers') }}" class="mb-4">
            <div class="flex items-center gap-2">
                <div class="flex-grow flex items-center">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Zoek op achternaam" class="border border-gray-300 p-2 rounded-lg w-full">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">Zoek</button>
                </div>
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
                            <th class="py-2 px-3 border-b text-left font-semibold">Naam</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Leeftijdscategorie</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Paspoort details</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Adres</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Email</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Mobiel</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Relatienummer</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Bewerken</th>
                            <th class="py-2 px-3 border-b text-left font-semibold">Verwijderen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-3 border-b">{{ $customer->full_name }}</td>
                                <td class="py-2 px-3 border-b">{{ $customer->age_category }}</td>
                                <td class="py-2 px-3 border-b">{{ $customer->passport_details }}</td>
                                <td class="py-2 px-3 border-b">{{ $customer->full_address }}</td>
                                <td class="py-2 px-3 border-b">
                                    <div class="flex items-center gap-2">
                                        <span class="masked-container">
                                            <span class="masked-content" data-content="{{ $customer->email }}">***@***.com</span>
                                        </span>
                                        <button type="button" class="visibility-toggle text-gray-500 hover:text-gray-700 focus:outline-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="py-2 px-3 border-b">
                                    <div class="flex items-center gap-2">
                                        <span class="phone-container">
                                            <span class="phone no-underline" data-phone="{{ $customer->mobile }}">06********</span>
                                        </span>
                                        <button type="button" class="visibility-toggle text-gray-500 hover:text-gray-700 focus:outline-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="py-2 px-3 border-b">{{ $customer->relation_number }}</td>
                                <td class="py-2 px-3 border-b">
                                    <a href="{{ route('customers.edit', ['customer' => $customer->person_id, 'page' => request('page', 1)]) }}" 
                                       class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-xs">
                                        Bewerken
                                    </a>
                                </td>
                                <td class="py-2 px-3 border-b">
                                    @if (!empty($customer->passport_details))
                                        <button class="bg-gray-400 text-white px-2 py-1 rounded cursor-not-allowed text-xs" disabled>Verwijderen</button>
                                    @else
                                        <form action="{{ route('customers.destroy', $customer->person_id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze klant wilt verwijderen?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">
                                                Verwijderen
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card view for small screens -->
            <div class="block md:hidden grid gap-3">
                @foreach ($customers as $customer)
                    <div class="bg-gray-50 p-3 rounded-lg shadow-md border border-gray-200">
                        <div class="mb-1">
                            <span class="font-semibold">Naam:</span>
                            <span>{{ $customer->full_name }}</span>
                        </div>
                        <div class="mb-1">
                            <span class="font-semibold">Leeftijdscategorie:</span>
                            <span>{{ $customer->age_category }}</span>
                        </div>
                        <div class="mb-1">
                            <span class="font-semibold">Paspoort details:</span>
                            <span>{{ $customer->passport_details }}</span>
                        </div>
                        <div class="mb-1">
                            <span class="font-semibold">Adres:</span>
                            <span>{{ $customer->full_address }}</span>
                        </div>
                        <div class="mb-1 flex items-center">
                            <span class="font-semibold">Email:</span>
                            <div class="flex items-center gap-2 ml-2">
                                <span class="masked-container">
                                    <span class="masked-content" data-content="{{ $customer->email }}">***@***.com</span>
                                </span>
                                <button type="button" class="visibility-toggle text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-1 flex items-center">
                            <span class="font-semibold">Mobiel:</span>
                            <div class="flex items-center gap-2 ml-2">
                                <span class="phone-container">
                                    <span class="phone no-underline" data-phone="{{ $customer->mobile }}">06********</span>
                                </span>
                                <button type="button" class="visibility-toggle text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-1">
                            <span class="font-semibold">Relatienummer:</span>
                            <span>{{ $customer->relation_number }}</span>
                        </div>
                        <div class="mt-3 flex justify-end gap-2">
                            <a href="{{ route('customers.edit', $customer->person_id) }}" 
                               class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 text-sm">
                                Bewerken
                            </a>
                            @if (!empty($customer->passport_details))
                                <button class="bg-gray-400 text-white px-3 py-1 rounded-lg cursor-not-allowed text-sm" disabled>Verwijderen</button>
                            @else
                                <form action="{{ route('customers.destroy', $customer->person_id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze klant wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="page" value="{{ request('page', 1) }}">
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 text-sm">
                                        Verwijderen
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
    <script>
        document.querySelectorAll('.visibility-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const contentSpan = this.parentElement.querySelector('.phone, .masked-content');
                const isPhone = contentSpan.classList.contains('phone');
                const currentContent = contentSpan.textContent;
                const storedContent = isPhone ? 
                    contentSpan.getAttribute('data-phone') : 
                    contentSpan.getAttribute('data-content');
                
                if (isPhone) {
                    contentSpan.textContent = currentContent === storedContent ? '06********' : storedContent;
                } else {
                    contentSpan.textContent = currentContent === storedContent ? '***@***.com' : storedContent;
                }
                
                this.classList.toggle('active');
            });
        });
    </script>
    <style>
        .phone-container {
            display: inline-block;
            min-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .masked-container {
            display: inline-block;
            min-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .phone,
        .masked-content {
            display: inline-block;
            width: 100%;
            padding-right: 2px;
        }

        /* Rest of the styles remain the same */
        .visibility-toggle {
            transition: transform 0.2s;
            padding: 2px;
            border-radius: 4px;
            flex-shrink: 0; /* Prevent eye icon from shrinking */
        }

        .visibility-toggle:hover {
            transform: scale(1.1);
            background-color: #f3f4f6;
        }

        .visibility-toggle.active {
            background-color: #e5e7eb;
        }

        .no-underline {
            text-decoration: none;
        }
    </style>
</body>
</html>
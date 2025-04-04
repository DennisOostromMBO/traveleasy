{{-- resources/views/communications/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Communications</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-7xl">
        <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Berichten</h1>

        <div class="mb-4 text-center sm:text-left">
            <a href="{{ route('communications.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Nieuwe Bericht
            </a>
        </div>
        
        {{-- Controleer of er berichten zijn --}}
        @if(count($messages) > 0)
            <div class="hidden md:block overflow-x-auto">
                <!-- Standard table for larger screens -->
                <table class="min-w-full bg-white border border-gray-200 text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 border-b text-left font-semibold">Klant Naam</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Werknemer Naam</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Berichten</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Verzenddatum</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop door alle berichten --}}
                        @foreach($messages as $message)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $message->customer_name }}</td>
                                <td class="py-3 px-4 border-b">{{ $message->employee_name }}</td>
                                <td class="py-3 px-4 border-b">{{ $message->message }}</td>
                                <td class="py-3 px-4 border-b">{{ $message->sent_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card view for small screens -->
            <div class="block md:hidden grid gap-4">
                @foreach($messages as $message)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md border border-gray-200">
                        <div class="mb-2">
                            <span class="font-semibold">Klant Naam:</span>
                            <span>{{ $message->customer_name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Werknemer Naam:</span>
                            <span>{{ $message->employee_name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Bericht(en):</span>
                            <span>{{ $message->message }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Verzenddatum:</span>
                            <span>{{ $message->sent_date }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Geen berichten gevonden
        @endif
    </div>
</body>
</html>

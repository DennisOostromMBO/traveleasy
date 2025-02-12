<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customers</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-7xl">
        <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Customers</h1>
            <div class="hidden md:block overflow-x-auto">
                <!-- Standard table for larger screens -->
                <table class="min-w-full bg-white border border-gray-200 text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 border-b text-left font-semibold">Naam</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Leeftijdcatogorie</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Paspoort Details</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Addres</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $customer->full_name }}</td>
                                <td class="py-3 px-4 border-b">{{ $customer->age_category }}</td>
                                <td class="py-3 px-4 border-b">{{ $customer->passport_details }}</td>
                                <td class="py-3 px-4 border-b">{{ $customer->full_address }}</td>
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
                            <span class="font-semibold">Leeftijdscatogorie:</span>
                            <span>{{ $customer->age_category }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Paspoort Details:</span>
                            <span>{{ $customer->passport_details }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Addres:</span>
                            <span>{{ $customer->full_address }}</span>
                        </div>
                    </div>
                @endforeach
         </div>
    </div>
</body>
</html>
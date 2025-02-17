<!-- filepath: /C:/Users/danie/OneDrive/Documenten/school mappen/Leerjaar 2/Project/Periode 3/traveleasy/resources/views/AccountOverview/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Overview</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-7xl">
        <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Account Overview</h1>

        <!-- Search and Sort Form -->
        <form method="GET" action="{{ url('/account-overview') }}" class="mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by email" class="border border-gray-300 p-2 rounded-lg w-full">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">Search</button>
            </div>
            <div class="flex items-center">
                <label for="sort_role" class="mr-2">Sort by Role:</label>
                <select name="sort_role" id="sort_role" class="border border-gray-300 p-2 rounded-lg">
                    <option value="">Select</option>
                    <option value="asc" {{ request('sort_role') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_role') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">Sort</button>
            </div>
        </form>

        <!-- User List -->
        @if ($users->isEmpty())
            <h3 class="text-red-500 text-center">Er zijn helaas geen gebruiker accounts.</h3>
        @else
            <div class="hidden md:block overflow-x-auto">
                <!-- Standard table for larger screens -->
                <table class="min-w-full bg-white border border-gray-200 text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 border-b text-left font-semibold">Full Name</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Email</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Role</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $user->full_name }}</td>
                                <td class="py-3 px-4 border-b">{{ $user->email }}</td>
                                <td class="py-3 px-4 border-b">{{ $user->role->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $user->is_active ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card view for small screens -->
            <div class="block md:hidden grid gap-4">
                @foreach ($users as $user)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md border border-gray-200">
                        <div class="mb-2">
                            <span class="font-semibold">Full Name:</span>
                            <span>{{ $user->full_name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Email:</span>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Role:</span>
                            <span>{{ $user->role->name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Active:</span>
                            <span>{{ $user->is_active ? 'Yes' : 'No' }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif

        <!-- Back to Home Button -->
        <div class="mt-6">
            <a href="{{ url('/') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Back to Home
            </a>
        </div>
    </div>
</body>
</html>
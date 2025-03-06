<!-- filepath: /c:/Users/danie/OneDrive/Documenten/school mappen/Leerjaar 2/Project/Periode 3/traveleasy/resources/views/accountOverview/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Account</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-3xl font-bold mb-6 text-center sm:text-left">Edit Account</h1>

        <form method="POST" action="{{ route('account.overview.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 font-bold mb-2">First Name:</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->person->first_name) }}" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="middle_name" class="block text-gray-700 font-bold mb-2">Middle Name:</label>
                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $user->person->middle_name) }}" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 font-bold mb-2">Last Name:</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->person->last_name) }}" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-bold mb-2">Role:</label>
                <select name="role" id="role" class="border border-gray-300 p-2 rounded-lg w-full">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="is_active" class="block text-gray-700 font-bold mb-2">Active:</label>
                <select name="is_active" id="is_active" class="border border-gray-300 p-2 rounded-lg w-full">
                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="comments" class="block text-gray-700 font-bold mb-2">Comments:</label>
                <textarea name="comments" id="comments" class="border border-gray-300 p-2 rounded-lg w-full">{{ old('comments', $user->comments) }}</textarea>
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">Save Changes</button>
            </div>
        </form>

        <form action="{{ route('account.overview.destroy', $user->id) }}" method="POST" class="inline-block mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-800">Delete Account</button>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nieuwe Bericht</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Nieuwe Bericht</h1>
        <form action="{{ route('communications.store') }}" method="POST">
            @csrf
            <div class="mb-4 relative">
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Klant Naam</label>
                <input type="text" id="customer_name" name="customer_name" autocomplete="off" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <div id="customer_suggestions" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-md w-full hidden">
                    <!-- Suggestions will be dynamically added here -->
                </div>
            </div>
            <input type="hidden" id="customer_id" name="customer_id">

            <div class="mb-4 relative">
                <label for="employee_name" class="block text-sm font-medium text-gray-700">Werknemer Naam</label>
                <input type="text" id="employee_name" name="employee_name" autocomplete="off" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <div id="employee_suggestions" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-md w-full hidden">
                    <!-- Suggestions will be dynamically added here -->
                </div>
            </div>
            <input type="hidden" id="employee_id" name="employee_id">

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Bericht</label>
                <textarea id="message" name="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Opslaan
                </button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            function setupAutocomplete(inputId, suggestionsId, hiddenId, route) {
                $(`#${inputId}`).on('input', function () {
                    const query = $(this).val();
                    if (query.length > 0) {
                        $.ajax({
                            url: route,
                            method: "GET",
                            data: { query },
                            success: function (data) {
                                const suggestions = $(`#${suggestionsId}`);
                                suggestions.empty();
                                if (data.length > 0) {
                                    data.forEach(item => {
                                        suggestions.append(`<div class="px-4 py-2 cursor-pointer hover:bg-gray-100" data-id="${item.person_id}" data-name="${item.full_name}">${item.full_name}</div>`);
                                    });
                                    suggestions.removeClass('hidden');
                                } else {
                                    suggestions.append('<div class="px-4 py-2 text-gray-500">Geen resultaten gevonden</div>');
                                    suggestions.removeClass('hidden');
                                }
                            }
                        });
                    } else {
                        $(`#${suggestionsId}`).addClass('hidden');
                    }
                });

                $(document).on('click', `#${suggestionsId} div`, function () {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    $(`#${hiddenId}`).val(id);
                    $(`#${inputId}`).val(name);
                    $(`#${suggestionsId}`).addClass('hidden');
                });

                $(document).click(function (e) {
                    if (!$(e.target).closest(`#${inputId}, #${suggestionsId}`).length) {
                        $(`#${suggestionsId}`).addClass('hidden');
                    }
                });
            }

            setupAutocomplete('customer_name', 'customer_suggestions', 'customer_id', "{{ route('customers.search') }}");
            setupAutocomplete('employee_name', 'employee_suggestions', 'employee_id', "{{ route('employees.search') }}");
        });
    </script>
</body>
</html>

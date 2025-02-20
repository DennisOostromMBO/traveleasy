<nav class="bg-blue-600 text-white py-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-4">
        <a href="{{ url('/') }}" class="text-2xl font-bold">TravelEasy</a>
        <div>
            <a href="{{ url('/account-overview')}}"class="ml-4 hover:underline">Accounts</a>
            <a href="{{ url('/communications') }}" class="ml-4 hover:underline">Berichten</a>
            <a href="{{ url('/travels') }}" class="ml-4 hover:underline">Reizen</a>
            <a href="{{ url('/invoices') }}" class="ml-4 hover:underline">Factuur</a>
            <a href="{{ url('/bookings') }}" class="ml-4 hover:underline">Boekingen</a> <!-- New link added -->
        </div>
    </div>
</nav>

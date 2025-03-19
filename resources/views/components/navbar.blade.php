<nav class="bg-blue-600 text-white py-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-4">
        <a href="{{ url('/') }}" class="text-2xl font-bold">TravelEasy</a>
        <div>
            <a href="{{ url('/maintenance') }}" class="hover:underline">Homepagina Maintenance</a>
            <a href="{{ url('/account-overview')}}"class="ml-4 hover:underline">Accounts</a>
            <a href="{{ url('/communications') }}" class="ml-4 hover:underline">Berichten</a>
            <a href="{{ url('/travels') }}" class="ml-4 hover:underline">Reizen</a>
            <a href="{{ url('/invoices') }}" class="ml-4 hover:underline">Factuur</a>
            <a href="{{ url('/bookings') }}" class="ml-4 hover:underline">Boekingen</a>
            <a href="{{ url('/explore') }}" class="ml-4 hover:underline">Ontdek</a>
            <a href="{{ url('/about') }}" class="ml-4 hover:underline">Over Ons</a>
            <a href="{{ url('/contact') }}" class="ml-4 hover:underline">Contact</a>
            <a href="{{ route('manager.bookings') }}" class="ml-4 hover:underline">Manager Dashboard</a> 

            @auth
            <span class="ml-4">|</span>
            <span class="ml-4">Welkom, {{ Auth::user()->name }}</span>
            <a href="{{ route('profile.edit') }}" class="ml-4 hover:underline">Profiel</a>
            <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                @csrf
                <button type="submit" class="hover:underline">Uitloggen</button>
            </form>
        @else
            <span class="ml-4">|</span>
            <a href="{{ route('login') }}" class="ml-4 hover:underline">Inloggen</a>
        @endauth

        </div>
    </div>
</nav>

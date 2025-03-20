<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welkom terug, ") }} {{ Auth::user()->name }}!
                </div>
                <div class="p-6 text-gray-900 bg-gray-100 rounded-lg mt-4 flex items-center justify-between">
                    <div class="text-left">
                        <h3 class="text-lg font-semibold">Vertrekplaats</h3>
                        <p class="text-sm">Amsterdam</p>
                    </div>
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        <p class="text-sm">Datum</p>
                        <p class="text-sm">2025-03-20</p>
                    </div>
                    <div class="text-right">
                        <h3 class="text-lg font-semibold">Bestemming</h3>
                        <p class="text-sm">New York</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Eerdere Vluchten</h3>
                        <ul>
                            <li class="mb-2">Amsterdam - Parijs (2025-01-15)</li>
                            <li class="mb-2">Amsterdam - Londen (2025-02-10)</li>
                            <li class="mb-2">Amsterdam - Berlijn (2025-03-05)</li>
                        </ul>
                    </div>
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Toekomstige Vluchten</h3>
                        <ul>
                            <li class="mb-2">Amsterdam - New York (2025-03-20)</li>
                            <li class="mb-2">Amsterdam - Tokyo (2025-04-10)</li>
                            <li class="mb-2">Amsterdam - Sydney (2025-05-05)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

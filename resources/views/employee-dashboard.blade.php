<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medewerker Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welkom op het Medewerker Dashboard!") }}
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
                    <!-- Knop 1 -->
                    <a href="{{ route('invoices.index') }}" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <h3 class="text-sm font-semibold text-center">{{ __('Facturen') }}</h3>
                    </a>

                    <!-- Knop 2 -->
                    

                    <!-- Knop 3 -->
                    <a href="{{ route('customers.index') }}" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25V9m9 0v10.5a2.25 2.25 0 0 1-2.25 2.25h-9A2.25 2.25 0 0 1 3 19.5V9m12.75 0h-9m9 0H21m-9 0H3m6 4.5h6m-6 3h6" />
                        </svg>
                        <h3 class="text-sm font-semibold text-center">{{ __('Klanten') }}</h3>
                    </a>

                    <!-- Knop 4 -->
                    <a href="{{ route('travels.index') }}" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 11h18M3 15h18M3 19h18" />
                        </svg>
                        <h3 class="text-sm font-semibold text-center">{{ __('Reizen') }}</h3>
                    </a>

                    <a href="{{ route('manager.bookings') }}" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                        <h3 class="text-sm font-semibold text-center">{{ __('Manager Dashboard') }}</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
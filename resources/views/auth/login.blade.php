<x-guest-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - TravelEasy</title>
        <!-- Include Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            body {
                background-image: url('{{ asset('img/sunbackground.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body class="flex items-center justify-center min-h-screen">
        <div class="bg-white bg-opacity-80 p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        {{ __('Registreren') }}
                    </a>
                    <x-primary-button class="ml-3">
                        {{ __('Inloggen') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </body>
    </html>
</x-guest-layout>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $companyName ?? config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-800">
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">{{ $companyName ?? config('app.name') }}</a>
                <div class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600">Beranda</a>
                    <a href="{{ route('shop.index') }}" class="text-gray-600 hover:text-indigo-600">Shop</a>
                    <a href="#about" class="text-gray-600 hover:text-indigo-600">Tentang</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">{{ $companyName ?? config('app.name') }}</h3>
                    <p class="text-gray-400">{{ $companyDescription ?? '' }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    @if(!empty($contactEmail))<p class="text-gray-400">Email: {{ $contactEmail }}</p>@endif
                    @if(!empty($contactPhone))<p class="text-gray-400">Telp: {{ $contactPhone }}</p>@endif
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Pembayaran</h3>
                    @if(!empty($bankName))
                        <p class="text-gray-400">{{ $bankName }}</p>
                        <p class="text-gray-400">{{ $bankAccount }}</p>
                        <p class="text-gray-400">a.n. {{ $bankHolder }}</p>
                    @endif
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500">
                &copy; {{ date('Y') }} {{ $companyName ?? config('app.name') }}. All rights reserved.
            </div>
        </div>
    </footer>

    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</body>
</html>

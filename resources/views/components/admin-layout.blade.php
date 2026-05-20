<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Compro-Kita') }} - Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200 pb-4">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    Produk
                </a>
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    Pesanan
                </a>
                <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    Pengaturan
                </a>
            </div>

            @isset($header)
                <header class="bg-white shadow-sm border border-gray-200 rounded-xl p-6 mb-6">
                    {{ $header }}
                </header>
            @endisset

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{ $slot }}
        </div>
    </div>
</body>
</html>

@php
    $companyName = $companyName ?? config('app.name');
    $companyTagline = $companyTagline ?? 'Solusi Source Code Terbaik';
    $companyDescription = $companyDescription ?? '';
    $contactEmail = $contactEmail ?? '';
    $contactPhone = $contactPhone ?? '';
    $bankName = $bankName ?? '';
    $bankAccount = $bankAccount ?? '';
    $bankHolder = $bankHolder ?? '';
@endphp

<x-front-layout :companyName="$companyName" :companyDescription="$companyDescription" :contactEmail="$contactEmail" :contactPhone="$contactPhone" :bankName="$bankName" :bankAccount="$bankAccount" :bankHolder="$bankHolder">
    <div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">{{ $companyTagline }}</h1>
            <p class="text-xl text-indigo-200 mb-8 max-w-3xl mx-auto">{{ $companyDescription }}</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('shop.index') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50">Lihat Produk</a>
                <a href="#about" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600">Tentang Kami</a>
            </div>
        </div>
    </div>

    <div id="about" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Tentang Kami</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">{{ $companyDescription }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Source Code Berkualitas</h3>
                <p class="text-gray-600 mt-2">Kode bersih, terstruktur, dan siap pakai untuk berbagai kebutuhan.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Dukungan Penuh</h3>
                <p class="text-gray-600 mt-2">Dapatkan bantuan instalasi dan konsultasi gratis.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Harga Terjangkau</h3>
                <p class="text-gray-600 mt-2">Solusi lengkap dengan harga yang ramah di kantong.</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Produk Terbaru</h2>
                <p class="text-gray-600 mt-4">Source code dan sistem siap pakai pilihan</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                <svg class="w-16 h-16 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded">{{ $product->category ?? 'Umum' }}</span>
                            <h3 class="text-lg font-semibold text-gray-900 mt-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mt-2 text-sm line-clamp-2">{{ $product->description }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('shop.show', $product) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        Belum ada produk tersedia.
                    </div>
                @endforelse
            </div>
            @if($products->count() > 0)
                <div class="text-center mt-8">
                    <a href="{{ route('shop.index') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700">Lihat Semua Produk</a>
                </div>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tertarik dengan produk kami?</h2>
        <p class="text-gray-600 mb-8">Hubungi kami untuk konsultasi atau informasi lebih lanjut</p>
        <div class="flex justify-center gap-4">
            @if(!empty($contactEmail))
                <a href="mailto:{{ $contactEmail }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700">Email Kami</a>
            @endif
            <a href="{{ route('shop.index') }}" class="border-2 border-indigo-600 text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50">Lihat Shop</a>
        </div>
    </div>
</x-front-layout>

<x-front-layout :companyName="$companyName" :companyDescription="$companyDescription" :contactEmail="$contactEmail" :contactPhone="$contactPhone" :bankName="$bankName" :bankAccount="$bankAccount" :bankHolder="$bankHolder">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Shop</h1>
        <p class="text-gray-600 mb-8">Pilih source code atau sistem yang Anda butuhkan</p>

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
                            <a href="{{ route('shop.show', $product) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">Beli</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <p class="text-gray-500 text-lg">Belum ada produk tersedia.</p>
                    <a href="{{ route('home') }}" class="text-indigo-600 hover:underline mt-2 inline-block">Kembali ke Beranda</a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-front-layout>

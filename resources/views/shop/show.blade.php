<x-front-layout :companyName="$companyName" :companyDescription="$companyDescription" :contactEmail="$contactEmail" :contactPhone="$contactPhone" :bankName="$bankName" :bankAccount="$bankAccount" :bankHolder="$bankHolder">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('shop.index') }}" class="text-indigo-600 hover:underline mb-4 inline-block">&larr; Kembali ke Shop</a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full rounded-xl shadow-sm" id="main-image">
                @else
                    <div class="w-full aspect-video bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-24 h-24 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>
                @endif

                @if($product->images && count($product->images) > 0)
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        @if($product->image)
                            <button onclick="document.getElementById('main-image').src='{{ Storage::url($product->image) }}'" class="border-2 border-indigo-500 rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($product->image) }}" class="w-full h-20 object-cover">
                            </button>
                        @endif
                        @foreach($product->images as $img)
                            <button onclick="document.getElementById('main-image').src='{{ Storage::url($img) }}'" class="border-2 border-transparent hover:border-indigo-500 rounded-lg overflow-hidden transition">
                                <img src="{{ Storage::url($img) }}" class="w-full h-20 object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
                <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded">{{ $product->category ?? 'Umum' }}</span>
                <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $product->name }}</h1>
                <p class="text-4xl font-bold text-indigo-600 mt-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-gray-600 mt-4">{{ $product->description }}</p>

                @if($product->features)
                    <div class="mt-6">
                        <h3 class="font-semibold text-gray-900 mb-2">Fitur:</h3>
                        <ul class="space-y-2">
                            @foreach($product->features as $feature)
                                <li class="flex items-start gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($product->content)
                    <div class="mt-8 border-t pt-8">
                        <h3 class="font-semibold text-gray-900 mb-4">Review / Detail</h3>
                        <div class="prose prose-sm max-w-none text-gray-600">
                            {!! $product->content !!}
                        </div>
                    </div>
                @endif

                <div class="mt-8 border-t pt-8">
                    <h3 class="font-semibold text-gray-900 mb-4">Pesan Sekarang</h3>
                    <form action="{{ route('shop.checkout', $product) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name', auth()->user()->name ?? '') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('customer_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="customer_email" required value="{{ old('customer_email', auth()->user()->email ?? '') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('customer_email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon (opsional)</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                            <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('notes') }}</textarea>
                        </div>

                        @if(!empty($bankName) && !empty($bankAccount))
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-sm font-medium text-yellow-800">Pembayaran:</p>
                                <p class="text-sm text-yellow-700">{{ $bankName }} - {{ $bankAccount }}</p>
                                <p class="text-sm text-yellow-700">a.n. {{ $bankHolder }}</p>
                            </div>
                        @endif

                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700">
                            Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>

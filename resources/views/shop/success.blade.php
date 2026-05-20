<x-front-layout :companyName="$companyName" :companyDescription="$companyDescription" :contactEmail="$contactEmail" :contactPhone="$contactPhone" :bankName="$bankName" :bankAccount="$bankAccount" :bankHolder="$bankHolder">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Pesanan Berhasil Dibuat!</h1>
            <p class="text-gray-600 mb-6">Terima kasih, {{ $order->customer_name }}. Silakan lakukan pembayaran ke rekening berikut:</p>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8 max-w-md mx-auto">
                <p class="font-semibold text-yellow-800 mb-2">Detail Pembayaran</p>
                <p class="text-yellow-700">Bank: {{ $bankName }}</p>
                <p class="text-yellow-700 text-lg font-bold">No. Rekening: {{ $bankAccount }}</p>
                <p class="text-yellow-700">a.n. {{ $bankHolder }}</p>
                <p class="text-yellow-700 mt-2">Total: <span class="font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</span></p>
            </div>

            <div class="text-left border rounded-lg p-6 mb-6">
                <h3 class="font-semibold text-gray-900 mb-3">Detail Pesanan</h3>
                @foreach($order->items as $item)
                    <div class="flex justify-between text-gray-600">
                        <span>{{ $item->product_name }} x{{ $item->quantity }}</span>
                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <div class="border-t mt-3 pt-3 flex justify-between font-bold text-gray-900">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <p class="text-gray-500 text-sm mb-6">Konfirmasi pembayaran: hubungi {{ $contactEmail ?: 'kami' }}</p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('shop.index') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Kembali ke Shop</a>
                <a href="{{ route('home') }}" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50">Ke Beranda</a>
            </div>
        </div>
    </div>
</x-front-layout>

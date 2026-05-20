<x-admin-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pesanan #{{ $order->id }}</h2>
    </x-slot:header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Informasi Customer</h3>
            <dl class="space-y-3">
                <div class="flex justify-between">
                    <dt class="text-gray-500">Nama</dt>
                    <dd class="font-medium">{{ $order->customer_name }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Email</dt>
                    <dd class="font-medium">{{ $order->customer_email }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Telepon</dt>
                    <dd class="font-medium">{{ $order->customer_phone ?? '-' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Tanggal</dt>
                    <dd class="font-medium">{{ $order->created_at->format('d M Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Status Pesanan</h3>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                    <select name="payment_status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">Update Status</button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Item Pesanan</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b">
                        <th class="pb-3">Produk</th>
                        <th class="pb-3">Harga</th>
                        <th class="pb-3">Qty</th>
                        <th class="pb-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b">
                            <td class="py-3">{{ $item->product_name }}</td>
                            <td class="py-3">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-3">{{ $item->quantity }}</td>
                            <td class="py-3">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="py-3 text-right font-bold">Total</td>
                        <td class="py-3 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($order->notes)
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-semibold text-lg text-gray-900 mb-2">Catatan</h3>
                <p class="text-gray-600">{{ $order->notes }}</p>
            </div>
        @endif
    </div>
</x-admin-layout>

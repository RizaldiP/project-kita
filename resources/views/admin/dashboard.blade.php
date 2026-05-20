<x-admin-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot:header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Total Produk</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Produk Aktif</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $activeProducts }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Total Pesanan</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Pesanan Pending</p>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <p class="text-3xl font-bold text-indigo-600 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Revenue Bulan Ini</p>
            <p class="text-3xl font-bold text-indigo-600 mt-1">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="font-semibold text-lg text-gray-900 mb-4">Pesanan Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b">
                        <th class="pb-3">ID</th>
                        <th class="pb-3">Customer</th>
                        <th class="pb-3">Total</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Pembayaran</th>
                        <th class="pb-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr class="border-b last:border-0">
                            <td class="py-3">#{{ $order->id }}</td>
                            <td class="py-3">{{ $order->customer_name }}</td>
                            <td class="py-3">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 rounded text-xs {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3">
                                <span class="px-2 py-1 rounded text-xs {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-gray-500">Belum ada pesanan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

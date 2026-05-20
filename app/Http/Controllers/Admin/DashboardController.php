<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $recentOrders = Order::with('items')->latest()->take(5)->get();

        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        return view('admin.dashboard', compact(
            'totalProducts', 'activeProducts', 'totalOrders',
            'pendingOrders', 'totalRevenue', 'monthlyRevenue', 'recentOrders'
        ));
    }
}

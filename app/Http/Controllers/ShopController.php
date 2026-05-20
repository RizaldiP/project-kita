<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    private function frontSettings(): array
    {
        return [
            'companyName' => Setting::getValue('company_name', 'Compro-Kita'),
            'companyDescription' => Setting::getValue('company_description', ''),
            'contactEmail' => Setting::getValue('contact_email', ''),
            'contactPhone' => Setting::getValue('contact_phone', ''),
            'bankName' => Setting::getValue('bank_name', ''),
            'bankAccount' => Setting::getValue('bank_account', ''),
            'bankHolder' => Setting::getValue('bank_holder', ''),
        ];
    }

    public function index(Request $request)
    {
        $category = $request->query('category');
        $query = Product::where('is_active', true);

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->latest()->paginate(12);
        $categories = Product::where('is_active', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('shop.index', array_merge(
            $this->frontSettings(),
            compact('products', 'categories', 'category')
        ));
    }

    public function show(Product $product)
    {
        return view('shop.show', array_merge(
            $this->frontSettings(),
            compact('product')
        ));
    }

    public function checkout(Request $request, Product $product)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        $settings = $this->frontSettings();

        if (empty($settings['bankAccount'])) {
            return back()->with('error', 'Pembayaran belum tersedia saat ini.');
        }

        $order = DB::transaction(function () use ($validated, $product) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'total' => $product->price,
                'status' => 'pending',
                'payment_method' => 'transfer',
                'payment_status' => 'pending',
                'notes' => $validated['notes'],
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'subtotal' => $product->price,
            ]);

            return $order;
        });

        return redirect()->route('shop.order.success', $order)
            ->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function success(Order $order)
    {
        return view('shop.success', array_merge(
            $this->frontSettings(),
            compact('order')
        ));
    }
}

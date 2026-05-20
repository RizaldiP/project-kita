<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['features'] = $validated['features'] ? explode("\n", str_replace("\r", "", $validated['features'])) : null;
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('products', 'public');
            }
            $validated['images'] = $paths;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['features'] = $validated['features'] ? explode("\n", str_replace("\r", "", $validated['features'])) : null;
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('images')) {
            $paths = $product->images ?? [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('products', 'public');
            }
            $validated['images'] = $paths;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function deleteImage(Product $product, $index)
    {
        $images = $product->images ?? [];
        if (isset($images[$index])) {
            unset($images[$index]);
            $product->update(['images' => array_values($images)]);
        }

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
